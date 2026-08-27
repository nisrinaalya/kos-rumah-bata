<?php

namespace App\Http\Controllers;

use App\Models\Kamar;
use App\Models\PengajuanSewa;
use App\Models\Pembayaran; // <-- Tambahkan import model Pembayaran baru
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;

class PengajuanSewaController extends Controller
{
    public function create($id)
    {
        $kamar = Kamar::where('id', $id)->where('status', 'tersedia')->firstOrFail();
        $userLogedIn = Auth::user();
        $sekarang = Carbon::now();
        $targetJuniTahunIni = Carbon::create($sekarang->year, 6, 1, 0, 0, 0);

        if ($sekarang->greaterThan($targetJuniTahunIni)) {
            $tanggalMulaiOtomatis = $targetJuniTahunIni->addYear()->format('Y-m-d');
        } else {
            $tanggalMulaiOtomatis = $targetJuniTahunIni->format('Y-m-d');
        }

        return view('ajukan-sewa', compact('kamar', 'tanggalMulaiOtomatis', 'userLogedIn'));
    }

    public function store(Request $request, $id)
    {
        $request->validate([
            'nama'            => 'required|string|max:255',
            'no_hp'           => 'required|string|max:20',
            'kontak_darurat'  => 'required|string|max:20',
            'tanggal_mulai'   => 'required|date|after_or_equal:today',
            'alamat'          => 'required|string',
            'ktp_dokumen'     => 'required_without:user_ktp|file|mimes:jpg,jpeg,png,pdf',
            'surat_komitmen'  => 'required_without:user_komitmen|file|mimes:pdf',
        ]);

        $kamar = Kamar::where('id', $id)->where('status', 'tersedia')->firstOrFail();
        $user = Auth::user();

        $pengajuanLama = PengajuanSewa::where('user_id', $user->id)->where('kamar_id', $kamar->id)->where('status', 'pending')->first();

        if ($pengajuanLama) {
            return redirect('/pembayaran/' . $pengajuanLama->order_id)->with('success', 'Anda sudah memiliki pengajuan aktif untuk kamar ini. Silakan lanjutkan pembayaran dengan Order ID: ' . $pengajuanLama->order_id);
        }

        $towerLower = strtolower($kamar->tower);
        $kodeTower = 'GJL';

        if (str_contains($towerLower, 'genap') || str_contains($towerLower, 'gnp')) {
            $kodeTower = 'GNP';
        } elseif (str_contains($towerLower, 'ganjil') || str_contains($towerLower, 'gjl')) {
            $kodeTower = 'GJL';
        }

        do {
            $randomNumber = str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT);
            $orderId = "KRB-{$kodeTower}-{$randomNumber}";
            $exists = PengajuanSewa::where('order_id', $orderId)->exists();
        } while ($exists);

        $tanggalMulai = $request->tanggal_mulai;
        $hitunganKamar = strtolower($kamar->dalam_hitungan ?? 'tahun');

        if (str_contains($hitunganKamar, 'bulan')) {
            $durasiSewa = (int) $hitunganKamar;
        } else {
            $durasiSewa = 12;
        }

        $ktpPath = $user->ktp_dokumen;
        if ($request->hasFile('ktp_dokumen')) {
            if ($user->ktp_dokumen) {
                $oldKtpPath = public_path($user->ktp_dokumen);
                if (File::exists($oldKtpPath)) {
                    File::delete($oldKtpPath);
                }
            }

            $fileKtp = $request->file('ktp_dokumen');
            $ktpName = time() . '-ktp.' . $fileKtp->getClientOriginalExtension();
            $fileKtp->move(public_path('documents/ktp'), $ktpName);
            $ktpPath = '/documents/ktp/' . $ktpName;
        }

        $suratPath = $user->surat_komitmen;
        if ($request->hasFile('surat_komitmen')) {
            if ($user->surat_komitmen) {
                $oldSuratPath = public_path($user->surat_komitmen);
                if (File::exists($oldSuratPath)) {
                    File::delete($oldSuratPath);
                }
            }

            $fileSurat = $request->file('surat_komitmen');
            $suratName = time() . '-komitmen.' . $fileSurat->getClientOriginalExtension();
            $fileSurat->move(public_path('documents/surat_komitmen'), $suratName);
            $suratPath = '/documents/surat_komitmen/' . $suratName;
        }

        $user->update([
            'ktp_dokumen'    => $ktpPath,
            'surat_komitmen' => $suratPath,
            'kontak_darurat' => $request->kontak_darurat,
            'alamat'         => $request->alamat,
        ]);

        PengajuanSewa::create([
            'order_id'        => $orderId,
            'user_id'         => $user->id,
            'kamar_id'        => $kamar->id,
            'tanggal_mulai'   => $tanggalMulai,
            'durasi_sewa'     => $durasiSewa,
            'status'          => 'pending',
        ]);

        return redirect('/pembayaran/' . $orderId)->with('success', 'Pengajuan sewa Anda berhasil dikirim dengan Order ID: ' . $orderId);
    }

    public function show($order_id)
    {
        $pengajuan = PengajuanSewa::where('order_id', $order_id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        // 1. Cari tahu apakah sudah ada DP yang disetujui oleh admin
        $hasApprovedDP = $pengajuan->pembayarans()
            ->where('tipe_pembayaran', 'dp')
            ->where('status', 'disetujui')
            ->exists();

        // 2. Ambil data pembayaran yang paling terakhir untuk mendeteksi status pending/rejected
        $pembayaranTerakhir = $pengajuan->pembayarans()->latest()->first();

        // 3. Jika sudah ada DP yang disetujui, tapi pembayaran terakhirnya bukan pelunasan yang ditolak (rejected),
        //    maka kita manipulasi objeknya agar Blade membaca ini sebagai halaman pelunasan/menunggu approval pelunasan.
        if ($hasApprovedDP) {
            // Cek apakah user sudah mengirim pelunasan dan sedang pending
            $pelunasanPending = $pengajuan->pembayarans()
                ->where('tipe_pembayaran', 'pelunasan')
                ->where('status', 'pending')
                ->first();

            if ($pelunasanPending) {
                // Jika pelunasan sedang ditinjau, biarkan $pembayaranTerakhir apa adanya (untuk ringkasan & status pending)
                $pembayaranTerakhir = $pelunasanPending;
            } elseif ($pembayaranTerakhir && $pembayaranTerakhir->status === 'rejected' && $pembayaranTerakhir->tipe_pembayaran === 'pelunasan') {
                // Jika pelunasan ditolak, biarkan system masuk ke mode Upload Ulang Pelunasan
                $pembayaranTerakhir = $pembayaranTerakhir;
            } else {
                // Jika belum bayar pelunasan sama sekali, paksa objek tiruan agar Blade mengunci ke form pelunasan (Kondisi 2)
                $pembayaranTerakhir = new \App\Models\Pembayaran([
                    'tipe_pembayaran' => 'dp',
                    'status' => 'approved'
                ]);
            }
        }

        return view('pembayaran', compact('pengajuan', 'pembayaranTerakhir'));
    }

    public function payment(Request $request, $order_id)
    {
        // 1. Validasi input dari form (menerima 'lunas', 'dp', atau 'pelunasan')
        $request->validate([
            'tipe_pembayaran' => 'required|in:lunas,dp,pelunasan',
            'bukti_transfer'  => 'required|image|mimes:jpg,jpeg,png'
        ], [
            'tipe_pembayaran.required' => 'Silahkan pilih tipe pembayaran.',
            'bukti_transfer.required'  => 'Silahkan unggah bukti transfer terlebih dahulu.',
            'bukti_transfer.image'     => 'Bukti transfer harus berupa gambar.',
        ]);

        // 2. Cari data pengajuan sewa milik user yang login
        $pengajuan = PengajuanSewa::where('order_id', $order_id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        if ($request->hasFile('bukti_transfer')) {
            // 3. Proses penyimpanan berkas file bukti transfer bank
            $fileBukti = $request->file('bukti_transfer');
            $buktiName = time() . '-bukti.' . $fileBukti->getClientOriginalExtension();
            $fileBukti->move(public_path('images/bukti_transfer'), $buktiName);
            $buktiPath = '/images/bukti_transfer/' . $buktiName;

            $hargaDasarKamar = $pengajuan->kamar->harga ?? 0;

            // 4. Ambil riwayat data pembayaran paling terakhir untuk pengecekan status
            $pembayaranTerakhir = Pembayaran::where('pengajuan_sewa_id', $pengajuan->id)
                ->latest()
                ->first();

            // =====================================================================
            // KONDISI 1: UPLOAD ULANG (Jika transaksi sebelumnya berstatus rejected)
            // =====================================================================
            if ($pembayaranTerakhir && $pembayaranTerakhir->status === 'ditolak') {

                // a. Update data transaksi pembayaran yang ditolak tersebut
                $pembayaranTerakhir->update([
                    'bukti_transfer' => $buktiPath,
                    'status'         => 'pending', // Kembalikan ke pending agar ditinjau ulang oleh admin
                    'tanggal_bayar'  => Carbon::today()->format('Y-m-d'),
                    'deskripsi'      => 'Re-upload pembayaran dari ' . Auth::user()->nama . ' untuk Kamar ' . $pengajuan->kamar->nomor_kamar,
                ]);

                // b. KEBUTUHAN BARU: Update status dan catatan pada tabel PengajuanSewa
                $pengajuan->update([
                    'status'  => 'pending', // Kembalikan status pengajuan sewa menjadi pending
                    'catatan' => 'User telah melakukan upload ulang bukti pembayaran terbaru.' // Memperbarui catatan/alasan reject sebelumnya
                ]);

            } else {
                // =====================================================================
                // KONDISI 2: TRANSAKSI BARU ATAU PELUNASAN SISA DP (Buat baris baru)
                // =====================================================================
                $tipePembayaranInv = 'full';
                $nominalBayar = $hargaDasarKamar;

                if ($request->tipe_pembayaran === 'dp') {
                    $tipePembayaranInv = 'dp';
                    $nominalBayar = $hargaDasarKamar / 2;
                } elseif ($request->tipe_pembayaran === 'pelunasan') {
                    $tipePembayaranInv = 'pelunasan';
                    $nominalBayar = $hargaDasarKamar / 2;
                }

                // Simpan transaksi baru ke tabel pembayarans
                Pembayaran::create([
                    'pengajuan_sewa_id' => $pengajuan->id,
                    'nominal'           => $nominalBayar,
                    'tipe_pembayaran'   => $tipePembayaranInv,
                    'tanggal_bayar'     => Carbon::today()->format('Y-m-d'),
                    'jenis'             => 'pemasukan',
                    'nama'              => 'Pembayaran Sewa ' . $pengajuan->kamar->nomor_kamar . ' (' . $tipePembayaranInv . ')',
                    'deskripsi'         => 'Pembayaran dari ' . Auth::user()->nama . ' untuk Kamar ' . $pengajuan->kamar->nomor_kamar,
                    'bukti_transfer'    => $buktiPath,
                    'status'            => 'pending',
                ]);
            }

            // 5. Pastikan status kamar tetap terkunci penuh selama proses peninjauan
            $pengajuan->kamar->update([
                'status' => 'penuh'
            ]);
        }

        // Mengembalikan session success_payment untuk memicu modal pop-up sukses bawaan di view Anda
        return redirect()->back()->with('success_payment', 'Bukti pembayaran berhasil diunggah.');
    }
}

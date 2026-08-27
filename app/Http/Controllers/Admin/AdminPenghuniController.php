<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Kamar;
use App\Models\PengajuanSewa;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\File;

class AdminPenghuniController extends Controller
{
    /**
     * Display a listing of the active tenants based on approved payments.
     */
    public function index()
    {
        // Ambil customer yang memiliki pengajuan sewa dengan pembayaran berstatus disetujui
        $penghuni = User::where('role', 'customer')
            ->whereHas('pengajuanSewa.pembayarans', function ($query) {
                $query->where('status', 'disetujui');
            })
            ->with(['pengajuanSewa' => function($query) {
                // Ambil pengajuan sewa yang pembayarannya disetujui beserta data kamar dan pembayarannya
                $query->whereHas('pembayarans', function($q) {
                    $q->where('status', 'disetujui');
                })->with(['kamar', 'pembayarans' => function($q) {
                    $q->where('status', 'disetujui');
                }]);
            }])
            ->orderBy('nama', 'asc')
            ->get();

        return view('admin.penghuni', compact('penghuni'));
    }

    /**
     * Display the specified tenant details.
     */
    public function show($id)
    {
        // Cari user berdasarkan ID yang memenuhi kriteria pembayaran disetujui
        $penghuni = User::where('role', 'customer')
            ->whereHas('pengajuanSewa.pembayarans', function ($query) {
                $query->where('status', 'disetujui');
            })
            ->with(['pengajuanSewa' => function($query) {
                $query->whereHas('pembayarans', function($q) {
                    $q->where('status', 'disetujui');
                })->with(['kamar', 'pembayarans' => function($q) {
                    $q->where('status', 'disetujui');
                }]);
            }])
            ->findOrFail($id);

        return view('admin.penghuni_detail', compact('penghuni'));
    }

    /**
     * Show the form for editing the specified tenant.
     */
    public function edit($id)
    {
        // Ambil data penghuni saat ini yang pembayaran sewanya valid
        $penghuni = User::where('role', 'customer')
            ->whereHas('pengajuanSewa.pembayarans', function ($query) {
                $query->where('status', 'disetujui');
            })
            ->with(['pengajuanSewa' => function($query) {
                $query->whereHas('pembayarans', function($q) {
                    $q->where('status', 'disetujui');
                })->with('kamar');
            }])
            ->findOrFail($id);

        // Ambil semua daftar kamar untuk pilihan opsi pindah kamar
        $allKamar = Kamar::all();

        return view('admin.penghuni_edit', compact('penghuni', 'allKamar'));
    }

    /**
     * Update the specified tenant in storage.
     */
    public function update(Request $request, $id)
    {
        // 1. Validasi input data profil dasar penghuni lengkap dengan data diri baru
        $request->validate([
            'nama'           => 'required|string|max:255',
            'email'          => 'required|email|unique:users,email,' . $id,
            'kamar_id'       => 'required|exists:kamars,id',
            'no_hp'          => 'nullable|string|max:20',
            'kontak_darurat' => 'nullable|string|max:20',
            'alamat'         => 'nullable|string',
            'foto_ktp'       => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:3072',
            'surat_komitmen' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:3072',
        ]);

        $penghuni = User::findOrFail($id);

        // Kumpulkan data teks untuk di-update di tabel users
        $userData = [
            'nama'           => $request->nama,
            'email'          => $request->email,
            'no_hp'          => $request->no_hp,
            'kontak_darurat' => $request->kontak_darurat,
            'alamat'         => $request->alamat,
        ];

        // --- HANDLER UPLOAD FOTO KTP (Gaya Lokal Public Luwihaja-Hill) ---
        if ($request->hasFile('foto_ktp')) {
            // Hapus berkas KTP fisik lama jika sebelumnya sudah ada path yang tersimpan
            if ($penghuni->ktp_dokumen) {
                $oldKtpPath = public_path($penghuni->ktp_dokumen);
                if (File::exists($oldKtpPath)) {
                    File::delete($oldKtpPath);
                }
            }

            $fileKtp = $request->file('foto_ktp');
            $ktpName = time() . '-ktp.' . $fileKtp->getClientOriginalExtension();
            $fileKtp->move(public_path('documents/ktp'), $ktpName);
            $userData['ktp_dokumen'] = '/documents/ktp/' . $ktpName;
        }

        // --- HANDLER UPLOAD SURAT KOMITMEN (Gaya Lokal Public Luwihaja-Hill) ---
        if ($request->hasFile('surat_komitmen')) {
            // Hapus berkas komitmen fisik lama jika sebelumnya sudah ada path yang tersimpan
            if ($penghuni->surat_komitmen) {
                $oldSuratPath = public_path($penghuni->surat_komitmen);
                if (File::exists($oldSuratPath)) {
                    File::delete($oldSuratPath);
                }
            }

            $fileSurat = $request->file('surat_komitmen');
            $suratName = time() . '-komitmen.' . $fileSurat->getClientOriginalExtension();
            $fileSurat->move(public_path('documents/surat_komitmen'), $suratName);
            $userData['surat_komitmen'] = '/documents/surat_komitmen/' . $suratName;
        }

        // Eksekusi update langsung memperbarui semua data diri ke tabel users
        $penghuni->update($userData);

        // Update kamar melalui pengajuan sewa yang terkait dengan pembayaran disetujui
        $sewaAktif = PengajuanSewa::where('user_id', $id)
            ->whereHas('pembayarans', function($query) {
                $query->where('status', 'disetujui');
            })
            ->first();

        if ($sewaAktif) {
            $sewaAktif->update([
                'kamar_id'       => $request->kamar_id,
                'nama'           => $request->nama,
                'no_hp'          => $request->no_hp,
                'kontak_darurat' => $request->kontak_darurat,
                'alamat'         => $request->alamat,
                // Sinkronisasikan berkas baru jika user melakukan re-upload dokumen
                'ktp_dokumen'    => $penghuni->ktp_dokumen,
                'surat_komitmen' => $penghuni->surat_komitmen,
            ]);
        }

        return redirect('/admin/penghuni')->with('success', 'Data penghuni berhasil diperbarui.');
    }

    /**
     * Remove the specified tenant from storage.
     */
    public function destroy($id)
    {
        // Cari pengajuan sewa terkait untuk pembatalan/pengosongan status sewa
        $sewaAktif = PengajuanSewa::where('user_id', $id)
            ->whereHas('pembayarans', function($query) {
                $query->where('status', 'disetujui');
            })
            ->first();

        if ($sewaAktif) {
            // Ubah status pengajuan sewa menjadi batal/ditolak agar status kamar kembali kosong/terbuka
            $sewaAktif->update([
                'status' => 'ditolak'
            ]);

            // Opsional: Jika Anda ingin membatalkan status pembayarannya juga di database
            $sewaAktif->pembayarans()->where('status', 'disetujui')->update([
                'status' => 'ditolak'
            ]);
        }

        return redirect()->back()->with('success', 'Penghuni berhasil dinonaktifkan dari kamar.');
    }

    public function pdf()
    {
        $penghuni = User::where('role', 'customer')
            ->whereHas('pengajuanSewa.pembayarans', function ($query) {
                $query->where('status', 'disetujui');
            })
            ->with(['pengajuanSewa' => function($query) {
                $query->whereHas('pembayarans', function($q) {
                    $q->where('status', 'disetujui');
                })->with(['kamar', 'pembayarans' => function($q) {
                    $q->where('status', 'disetujui');
                }]);
            }])
            ->orderBy('nama', 'asc')
            ->get();

        $totalPenghuni = $penghuni->count();
        $tanggalCetak = date('d M Y');

        $pdf = Pdf::loadView('admin.penghuni_pdf', compact('penghuni', 'totalPenghuni', 'tanggalCetak'));

        return $pdf->download('Data_Penghuni_Kos_Rumah_Bata_' . date('Y-m-d') . '.pdf');
    }
}

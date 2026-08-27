<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use Illuminate\Http\Request;

class AdminPembayaranController extends Controller
{
    public function index()
    {
        // Ambil semua data dari tabel pembayarans yang bertipe pemasukan
        $pembayaran = Pembayaran::with(['pengajuanSewa.user', 'pengajuanSewa.kamar'])
            ->where('jenis', 'pemasukan')
            ->orderBy('created_at', 'desc')
            ->get();

        // Hitung data summary secara dinamis berdasarkan status pembayaran
        $totalMasuk = $pembayaran->count();
        $menungguVerifikasi = $pembayaran->where('status', 'pending')->count();
        $terverifikasi = $pembayaran->where('status', 'disetujui')->count();
        $uploadUlang = $pembayaran->where('status', 'ditolak')->count();

        return view('admin.pembayaran', compact(
            'pembayaran',
            'totalMasuk',
            'menungguVerifikasi',
            'terverifikasi',
            'uploadUlang'
        ));
    }

    public function show($id)
    {
        // Parameter diubah mencari berdasarkan ID primary key dari tabel pembayarans
        $pembayaranItem = Pembayaran::with(['pengajuanSewa.user', 'pengajuanSewa.kamar'])
            ->findOrFail($id);

        // Mengirimkan variabel pengajuan agar struktur blade detail lama Anda tidak pecah
        $pengajuan = $pembayaranItem->pengajuanSewa;

        return view('admin.pembayaran_detail', compact('pengajuan', 'pembayaranItem'));
    }

    /**
     * Memproses persetujuan atau penolakan transaksi pembayaran dari admin
     */
    public function verifikasi(Request $request, $id)
    {
        $pembayaranItem = Pembayaran::with('pengajuanSewa.kamar')->findOrFail($id);
        $pengajuan = $pembayaranItem->pengajuanSewa;

        $action = $request->input('action');
        $catatanAdmin = $request->input('catatan_admin');

        if ($action === 'setuju') {
            // Update status pada baris transaksi pembayaran yang dipilih
            $pembayaranItem->update([
                'status' => 'disetujui',
                'deskripsi' => $pembayaranItem->deskripsi . ' (Disetujui Admin)'
            ]);

            // Jika tipe pembayarannya adalah Lunas langsung ('full') atau Pelunasan sisa DP,
            // Maka set status utama kontrak pengajuan sewa menjadi disetujui
            if (in_array($pembayaranItem->tipe_pembayaran, ['full', 'pelunasan'])) {
                $pengajuan->update([
                    'status' => 'disetujui',
                ]);
            }

            // Pastikan status kamar berubah menjadi 'penuh'
            if ($pengajuan && $pengajuan->kamar) {
                $pengajuan->kamar->update([
                    'status' => 'penuh'
                ]);
            }

            return redirect('/admin/pembayaran/' . $id)
                ->with('success', 'Transaksi pembayaran berhasil diverifikasi dan disetujui.');

        } elseif ($action === 'tolak') {
            $request->validate([
                'catatan_admin' => 'required|string|min:5'
            ], [
                'catatan_admin.required' => 'Silakan tulis alasan penolakan pada catatan admin terlebih dahulu.'
            ]);

            // Update status transaksi pembayaran menjadi ditolak
            $pembayaranItem->update([
                'status' => 'ditolak',
                'deskripsi' => $catatanAdmin,
            ]);

            // Ubah status pengajuan sewa utama menjadi ditolak agar user mendapat notifikasi/instruksi upload ulang
            $pengajuan->update([
                'status' => 'ditolak',
                'catatan' => $catatanAdmin // menyimpan pesan error ke user
            ]);

            // Kembalikan status kamar menjadi 'tersedia' jika penolakan membatalkan pemesanan awal
            if ($pengajuan && $pengajuan->kamar) {
                $pengajuan->kamar->update([
                    'status' => 'tersedia'
                ]);
            }

            return redirect('/admin/pembayaran/' . $id)
                ->with('success', 'Transaksi pembayaran telah ditolak.');
        }

        return redirect('/admin/pembayaran/' . $id);
    }
}

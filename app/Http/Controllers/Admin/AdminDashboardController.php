<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kamar;
use App\Models\User;
use App\Models\Pembayaran;
use App\Models\Maintenance;
use App\Models\PengajuanSewa;
use Carbon\Carbon;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // 1. STATISTIK KARTU UTAS
        $totalKamar = Kamar::count();

        // Penghuni Aktif
        $penghuniAktif = User::where('role', 'customer')
            ->whereHas('pengajuanSewa.pembayarans', function ($query) {
                $query->where('status', 'disetujui');
            })->count();

        // Pembayaran DP Pending
        $pembayaranDP = Pembayaran::where('jenis', 'pemasukan')
            ->where('status', 'pending')
            ->count();

        // Total Maintenance
        $maintenanceCount = Maintenance::count();


        // 2. LOGIKA PETA KAMAR URUT NUMERIK MURNI (HORIZONTAL 1 - 40)
        // Mengambil semua ID kamar yang bermasalah di tabel maintenance
        $maintenanceKamarIds = Maintenance::pluck('kamar_id')->toArray();

        // Menggunakan orderByRaw CAST agar nomor string seperti '1', '2', '10' diurutkan secara angka (1, 2, 3... 10, 11)
        $rawKamars = Kamar::orderByRaw('CAST(nomor_kamar AS INTEGER) ASC')->get();
        $kamars = collect();

        foreach ($rawKamars as $kamar) {
            // Evaluasi status fungsional berdasarkan aturan relasi database Anda
            if (in_array($kamar->id, $maintenanceKamarIds)) {
                $kamar->status_visual = 'maintenance'; // Warna Jingga (#b77700)
            } elseif ($kamar->status === 'penuh') {
                $kamar->status_visual = 'terisi'; // Warna Cokelat/Merah Bata (#c8664a)
            } else {
                $kamar->status_visual = 'kosong'; // Warna Putih (#ffffff) / status tersedia
            }
            $kamars->push($kamar);
        }


        // 3. LOGIKA AKTIVITAS TERBARU (GABUNGAN REAL-TIME)
        $aktivitas = collect();

        // A. Log Pembayaran Riil (P)
        $pembayaransLog = Pembayaran::with(['pengajuanSewa.user', 'pengajuanSewa.kamar'])
            ->where('jenis', 'pemasukan')
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        foreach ($pembayaransLog as $p) {
            $nama = $p->pengajuanSewa->user->name ?? 'Penghuni';
            $noKamar = $p->pengajuanSewa->kamar->nomor_kamar ?? '';
            $noKamarPad = $noKamar ? str_pad($noKamar, 2, '0', STR_PAD_LEFT) : '';

            $aktivitas->push([
                'icon' => 'P',
                'title' => 'Pembayaran diterima',
                'description' => "{$nama} mengirim bukti Transfer Kamar {$noKamarPad}.",
                'time' => Carbon::parse($p->created_at),
            ]);
        }

        // B. Log Pengajuan Sewa Riil (S)
        $sewaLog = PengajuanSewa::with(['user', 'kamar'])
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        foreach ($sewaLog as $s) {
            $nama = $s->user->name ?? 'Calon Penghuni';
            $noKamar = $s->kamar->nomor_kamar ?? '';
            $noKamarPad = $noKamar ? str_pad($noKamar, 2, '0', STR_PAD_LEFT) : '';

            $aktivitas->push([
                'icon' => 'S',
                'title' => 'Pengajuan sewa baru',
                'description' => "Calon penghuni mengajukan Kamar {$noKamarPad}.",
                'time' => Carbon::parse($s->created_at),
            ]);
        }

        // C. Log Laporan Maintenance Riil (M)
        $maintenancesLog = Maintenance::with(['kamar'])
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        foreach ($maintenancesLog as $m) {
            $noKamar = $m->kamar->nomor_kamar ?? '';
            $noKamarPad = $noKamar ? str_pad($noKamar, 2, '0', STR_PAD_LEFT) : '';
            $deskripsiKerusakan = $m->deskripsi ?? 'saluran air tersumbat';

            $aktivitas->push([
                'icon' => 'M',
                'title' => 'Laporan maintenance masuk',
                'description' => "Kamar {$noKamarPad} melaporkan " . strtolower($deskripsiKerusakan) . ".",
                'time' => Carbon::parse($m->created_at),
            ]);
        }

        // Filter ambil 4 aktivitas paling baru secara gabungan keseluruhan timeline
        $recentActivities = $aktivitas->sortByDesc('time')->take(10);

        return view('admin.dashboard', compact(
            'totalKamar',
            'penghuniAktif',
            'pembayaranDP',
            'maintenanceCount',
            'kamars',
            'recentActivities'
        ));
    }
}

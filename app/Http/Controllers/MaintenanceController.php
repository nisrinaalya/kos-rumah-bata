<?php

namespace App\Http\Controllers;

use App\Models\Maintenance;
use App\Models\PengajuanSewa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MaintenanceController extends Controller
{
    /**
     * Menampilkan form pengajuan & riwayat maintenance milik user login
     */
    public function index()
    {
        $user = Auth::user();

        // Cari data sewa aktif milik user untuk mendapatkan nomor kamar otomatis
        $sewaAktif = PengajuanSewa::where('user_id', $user->id)
            ->where('status', 'disetujui') // Menyesuaikan dengan flow kos Anda
            ->with('kamar')
            ->first();

        // Jika user memiliki sewa aktif, ambil nomor kamarnya sebagai default value
        $nomorKamarDefault = '';
        if ($sewaAktif && $sewaAktif->kamar) {
            $nomorKamarDefault = sprintf("%02d", $sewaAktif->kamar->nomor_kamar);
        }

        // Ambil riwayat laporan maintenance khusus yang diajukan untuk kamar milik user tersebut
        $riwayatMaintenances = collect();
        if ($sewaAktif) {
            $riwayatMaintenances = Maintenance::where('kamar_id', $sewaAktif->kamar_id)
                ->latest()
                ->get();
        }

        return view('laporan-fasilitas', compact('nomorKamarDefault', 'riwayatMaintenances', 'sewaAktif'));
    }

    /**
     * Memproses penyimpanan laporan kerusakan dari user
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        // Dapatkan data sewa untuk memastikan kamar_id valid
        $sewaAktif = PengajuanSewa::where('user_id', $user->id)
            ->where('status', 'disetujui')
            ->first();

        if (!$sewaAktif) {
            return redirect()->back()->with('error', 'Anda belum memiliki kamar aktif untuk dilaporkan.');
        }

        $request->validate([
            'nama_perbaikan'        => 'required|string',
            'deskripsi'        => 'required|string|min:5',
            'foto_maintenance' => 'nullable|image|mimes:jpeg,png,jpg|max:5120', // Maks 5MB sesuai teks blade
        ]);

        $data = [
            'kamar_id'         => $sewaAktif->kamar_id,
            'nama_perbaikan'   => $request->nama_perbaikan,
            'status'           => 'menunggu',
            'tanggal_laporan' => now()->format('Y-m-d'),
            'deskripsi'        => $request->deskripsi,
            'biaya'            => null,
            'estimasi_selesai' => null,
        ];

        // Proses unggah foto jika ada berkas dipilih
        if ($request->hasFile('foto_maintenance')) {
            $file = $request->file('foto_maintenance');
            $filename = time() . '_user_' . $file->getClientOriginalName();
            $file->move(public_path('images/maintenance'), $filename);
            $data['foto_maintenance'] = $filename;
        }

        Maintenance::create($data);

        return redirect()->back()->with('success', 'Laporan kerusakan fasilitas berhasil dikirim.');
    }
}

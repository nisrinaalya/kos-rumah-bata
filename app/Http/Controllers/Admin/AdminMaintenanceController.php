<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Maintenance;
use App\Models\Kamar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AdminMaintenanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mengambil semua data perbaikan beserta data kamarnya
        $maintenances = Maintenance::with('kamar')->latest()->get();
        return view('admin.maintenance', compact('maintenances'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Mengambil seluruh data kamar untuk pilihan opsi di blade
        $kamars = Kamar::all();
        return view('admin.maintenance_create', compact('kamars'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kamar'             => 'required|exists:kamars,id',
            'status'            => 'required|in:menunggu,proses,selesai',
            'nama_perbaikan'    => 'required|string|max:255',
            'biaya'             => 'nullable|string', // String karena input bisa membawa format "Rp 250.000"
            'tanggal_laporan'   => 'nullable|date',
            'estimasi_selesai'  => 'nullable|date',
            'deskripsi'         => 'nullable|string',
            'foto_maintenance'  => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);

        // Membersihkan format string Rp dan titik dari input biaya agar tersimpan sebagai angka/integer
        $biayaCleaned = null;
        if ($request->biaya) {
            $biayaCleaned = preg_replace('/[^0-9]/', '', $request->biaya);
        }

        $data = [
            'kamar_id'         => $request->kamar,
            'nama_perbaikan'   => $request->nama_perbaikan,
            'status'           => $request->status,
            'biaya'            => $biayaCleaned,
            'tanggal_laporan'  => $request->tanggal_laporan,
            'estimasi_selesai' => $request->estimasi_selesai,
            'deskripsi'        => $request->deskripsi,
        ];

        // Proses upload file foto jika ada
        if ($request->hasFile('foto_maintenance')) {
            $file = $request->file('foto_maintenance');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/maintenance'), $filename);
            $data['foto_maintenance'] = $filename;
        }

        Maintenance::create($data);

        return redirect()->route('maintenance.index')->with('success', 'Data perbaikan berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $maintenance = Maintenance::with('kamar')->findOrFail($id);
        return view('admin.maintenance_detail', compact('maintenance'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $maintenance = Maintenance::findOrFail($id);
        $kamars = Kamar::all();
        return view('admin.maintenance_edit', compact('maintenance', 'kamars'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $maintenance = Maintenance::findOrFail($id);

        $request->validate([
            'kamar'             => 'required|exists:kamars,id',
            'status'            => 'required|in:menunggu,proses,selesai',
            'nama_perbaikan'    => 'required|string|max:255',
            'biaya'             => 'nullable|string',
            'tanggal_laporan'   => 'nullable|date',
            'estimasi_selesai'  => 'nullable|date',
            'deskripsi'         => 'nullable|string',
            'foto_maintenance'  => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);

        $biayaCleaned = null;
        if ($request->biaya) {
            $biayaCleaned = preg_replace('/[^0-9]/', '', $request->biaya);
        }

        $data = [
            'kamar_id'         => $request->kamar,
            'nama_perbaikan'   => $request->nama_perbaikan,
            'status'           => $request->status,
            'biaya'            => $biayaCleaned,
            'tanggal_laporan'  => $request->tanggal_laporan,
            'estimasi_selesai' => $request->estimasi_selesai,
            'deskripsi'        => $request->deskripsi,
        ];

        // Jika user mengunggah foto baru
        if ($request->hasFile('foto_maintenance')) {
            $file = $request->file('foto_maintenance');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/maintenance'), $filename);

            // Hapus foto lama dari local storage jika ada agar tidak memenuhi server
            if ($maintenance->foto_maintenance && File::exists(public_path('images/maintenance/' . $maintenance->foto_maintenance))) {
                File::delete(public_path('images/maintenance/' . $maintenance->foto_maintenance));
            }

            $data['foto_maintenance'] = $filename;
        }

        $maintenance->update($data);

        return redirect()->route('maintenance.index')->with('success', 'Data perbaikan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $maintenance = Maintenance::findOrFail($id);

        // Hapus file foto dari server sebelum menghapus datanya di database
        if ($maintenance->foto_maintenance && File::exists(public_path('images/maintenance/' . $maintenance->foto_maintenance))) {
            File::delete(public_path('images/maintenance/' . $maintenance->foto_maintenance));
        }

        $maintenance->delete();

        return redirect()->route('maintenance.index')->with('success', 'Data perbaikan berhasil dihapus.');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kamar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AdminKamarController extends Controller
{
    public function index()
    {
        $kamars = Kamar::orderBy('id', 'desc')->get();
        return view('admin.kamar', compact('kamars'));
    }

    public function create()
    {
        return view('admin.kamar_create');
    }

    // PROSES SIMPAN KAMAR BARU
    public function store(Request $request)
    {
        $request->validate([
            'nomor_kamar'     => 'required|string|max:10',
            'tower'           => 'required|string|max:50',
            'tipe_kamar'      => 'required|in:ac,non-ac',
            'harga'           => 'required|numeric',
            'dalam_hitungan'  => 'required|string|max:50', // Menangkap pilihan periode sewa (tahun / X bulan)
            'luas'            => 'required|string|max:30',
            'fasilitas'       => 'required|array',
            'deskripsi'       => 'required|string',
            'status'          => 'required|in:tersedia,penuh', // Menghapus duplikasi baris typo penfull
            'foto_utama'      => 'required|image|mimes:jpeg,png,jpg,webp',
            'foto_tambahan_1' => 'required|image|mimes:jpeg,png,jpg,webp',
            'foto_tambahan_2' => 'required|image|mimes:jpeg,png,jpg,webp',
            'foto_tambahan_3' => 'required|image|mimes:jpeg,png,jpg,webp',
        ]);

        $data = $request->all();

        // 1. Upload Foto Utama
        if ($request->hasFile('foto_utama')) {
            $file = $request->file('foto_utama');
            $filename = time() . '-utama.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/kamar'), $filename);
            $data['foto_utama'] = '/images/kamar/' . $filename;
        }

        // 2. Upload Foto Tambahan (1, 2, 3)
        for ($i = 1; $i <= 3; $i++) {
            $inputName = 'foto_tambahan_' . $i;
            if ($request->hasFile($inputName)) {
                $file = $request->file($inputName);
                $filename = time() . '-tambahan-' . $i . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('images/kamar'), $filename);
                $data[$inputName] = '/images/kamar/' . $filename;
            }
        }

        Kamar::create($data);

        return redirect('/admin/kamar')->with('success', 'Kamar berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $kamar = Kamar::findOrFail($id);
        return view('admin.kamar_edit', compact('kamar'));
    }

    // PROSES UPDATE DATA KAMAR
    public function update(Request $request, $id)
    {
        $kamar = Kamar::findOrFail($id);

        $request->validate([
            'nomor_kamar'     => 'required|string|max:10',
            'tower'           => 'required|string|max:50',
            'tipe_kamar'      => 'required|in:ac,non-ac',
            'harga'           => 'required|numeric',
            'dalam_hitungan'  => 'required|string|max:50', // Validasi kolom periode sewa saat diperbarui
            'luas'            => 'required|string|max:30',
            'fasilitas'       => 'required|array',
            'deskripsi'       => 'required|string',
            'status'          => 'required|in:tersedia,penfull',
            'status'          => 'required|in:tersedia,penuh', // Menghapus duplikasi baris typo penfull
            'foto_utama'      => 'nullable|image|mimes:jpeg,png,jpg,webp',
            'foto_tambahan_1' => 'nullable|image|mimes:jpeg,png,jpg,webp',
            'foto_tambahan_2' => 'nullable|image|mimes:jpeg,png,jpg,webp',
            'foto_tambahan_3' => 'nullable|image|mimes:jpeg,png,jpg,webp',
        ]);

        $data = $request->all();

        // 1. Update Foto Utama (Hapus berkas fisik lama jika mengunggah foto baru)
        if ($request->hasFile('foto_utama')) {
            if ($kamar->foto_utama) {
                $oldPath = public_path($kamar->foto_utama);
                if (File::exists($oldPath)) {
                    File::delete($oldPath);
                }
            }
            $file = $request->file('foto_utama');
            $filename = time() . '-utama.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/kamar'), $filename);
            $data['foto_utama'] = '/images/kamar/' . $filename;
        }

        // 2. Update Foto Tambahan (1, 2, 3) (Hapus berkas fisik lama jika mengunggah foto baru)
        for ($i = 1; $i <= 3; $i++) {
            $inputName = 'foto_tambahan_' . $i;
            if ($request->hasFile($inputName)) {
                if ($kamar->$inputName) {
                    $oldPath = public_path($kamar->$inputName);
                    if (File::exists($oldPath)) {
                        File::delete($oldPath);
                    }
                }
                $file = $request->file($inputName);
                $filename = time() . '-tambahan-' . $i . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('images/kamar'), $filename);
                $data[$inputName] = '/images/kamar/' . $filename;
            }
        }

        $kamar->update($data);

        return redirect('/admin/kamar')->with('success', 'Data kamar berhasil diperbarui!');
    }

    // PROSES HAPUS KAMAR TOTAL
    public function destroy($id)
    {
        $kamar = Kamar::findOrFail($id);

        // Hapus berkas utama dari local drive
        if ($kamar->foto_utama) {
            $pathUtama = public_path($kamar->foto_utama);
            if (File::exists($pathUtama)) {
                File::delete($pathUtama);
            }
        }

        // Hapus seluruh berkas tambahan dari local drive
        for ($i = 1; $i <= 3; $i++) {
            $fieldName = 'foto_tambahan_' . $i;
            if ($kamar->$fieldName) {
                $pathTambahan = public_path($kamar->$fieldName);
                if (File::exists($pathTambahan)) {
                    File::delete($pathTambahan);
                }
            }
        }

        $kamar->delete();

        return redirect('/admin/kamar')->with('success', 'Kamar berhasil dihapus!');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Galeri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File; // Menggunakan Facade File sesuai gaya luwihaja-hill

class AdminGaleriController extends Controller
{
    // 1. TAMPILKAN DAFTAR GALERI (Halaman Utama Admin)
    public function index()
    {
        $galeris = Galeri::orderBy('sort_order', 'asc')->get();
        return view('admin.konten_galeri', compact('galeris'));
    }

    // 2. FORM TAMBAH DATA GALERI
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif',
            'status' => 'required|in:aktif,nonaktif',
            'sort_order' => 'required|integer|min:1',
        ]);

        // --- UPDATE PROSES UPLOAD GAMBAR BARU (Gaya Lokal Public Luwihaja-Hill) ---
        $imagePath = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '-galeri.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/galeri'), $filename);
            $imagePath = '/images/galeri/' . $filename;
        }

        Galeri::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $imagePath,
            'status' => $request->status,
            'sort_order' => $request->sort_order,
        ]);

        return redirect()->route('galeri.index')->with('success', 'Foto galeri berhasil ditambahkan!');
    }

    // 3. FORM EDIT DATA GALERI
    public function edit($id)
    {
        $galeri = Galeri::findOrFail($id);
        return view('admin.konten_galeri_edit', compact('galeri'));
    }

    // 4. PROSES UPDATE DATA (Bagian Utama yang Memperbaiki Redirect)
    public function update(Request $request, $id)
    {
        $galeri = Galeri::findOrFail($id);

        // Validasi input
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'status' => 'required|in:aktif,nonaktif',
            'sort_order' => 'required|integer|min:1',
        ]);

        // Kumpulkan data teks
        $data = [
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
            'sort_order' => $request->sort_order,
        ];

        // --- UPDATE PROSES UPDATE GAMBAR (Gaya Lokal Public Luwihaja-Hill) ---
        if ($request->hasFile('image')) {
            // Hapus file fisik lama menggunakan Facade File jika sebelumnya path tersimpan
            if ($galeri->image) {
                $oldPath = public_path($galeri->image);
                if (File::exists($oldPath)) {
                    File::delete($oldPath);
                }
            }

            $file = $request->file('image');
            $filename = time() . '-galeri.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/galeri'), $filename);
            $data['image'] = '/images/galeri/' . $filename;
        } else {
            // Tetap gunakan foto lama jika tidak ada unggahan baru
            $data['image'] = $galeri->image;
        }

        // Eksekusi Update ke Database
        $galeri->update($data);

        // LANGSUNG REDIRECT KEMBALI KE KONTEN GALERI (INDEX)
        return redirect()->route('galeri.index')->with('success', 'Foto galeri berhasil diperbarui!');
    }

    // 5. PROSES HAPUS FOTO
    public function destroy($id)
    {
        $galeri = Galeri::findOrFail($id);

        // --- UPDATE PROSES HAPUS GAMBAR TOTAL (Gaya Lokal Public Luwihaja-Hill) ---
        if ($galeri->image) {
            $path = public_path($galeri->image);
            if (File::exists($path)) {
                File::delete($path);
            }
        }

        $galeri->delete();

        return redirect()->route('galeri.index')->with('success', 'Foto galeri berhasil dihapus!');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Kamar;

class KamarController extends Controller
{
    /**
     * Menampilkan daftar seluruh kamar untuk halaman pelanggan.
     */
    public function index()
    {
        $kamars = Kamar::orderBy('id', 'desc')->get();

        return view('kamar', compact('kamars'));
    }

    /**
     * Menampilkan detail informasi dari kamar tertentu.
     */
    public function show($id)
    {
        $kamar = Kamar::findOrFail($id);

        return view('detail-kamar', compact('kamar'));
    }
}

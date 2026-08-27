<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\Activity;
use App\Models\Galeri;
use App\Models\Kamar;

class HomeController extends Controller
{
    public function index()
    {
        // Hanya mengambil FAQ yang berstatus aktif untuk ditampilkan ke pelanggan
        $faqs = Faq::where('status', 'aktif')->orderBy('sort_order', 'asc')->get();
        $kamars = Kamar::where('status', 'tersedia')->latest()->take(3)->get();

        return view('home', compact('faqs', 'kamars'));
    }

    public function galeri()
    {
        // Mengambil foto galeri yang aktif diurutkan berdasarkan sort_order
        $galeris = Galeri::where('status', 'aktif')
                         ->orderBy('sort_order', 'asc')
                         ->get();

        // Mengirim data ke view home.blade.php
        return view('about', compact('galeris'));
    }

    public function activity()
    {
        $activities = Activity::where('status', 'aktif')
                              ->orderBy('is_pinned', 'desc')
                              ->orderBy('date', 'desc')
                              ->get();

        return view('activity', compact('activities'));
    }
}

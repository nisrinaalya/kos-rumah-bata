<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function index()
    {
        // Cukup gunakan SATU query cerdas dengan dua urutan (orderBy)
        // Urutan 1: Utamakan yang disematkan (is_pinned = 1 akan berada di atas)
        // Urutan 2: Urutkan berdasarkan tanggal rilis terbaru (date desc)
        $activities = Activity::where('status', 'aktif')
                              ->orderBy('is_pinned', 'desc')
                              ->orderBy('date', 'desc')
                              ->get();

        return view('activity', compact('activities'));
    }
}
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class AdminFaqController extends Controller
{
    // Menampilkan halaman utama FAQ di Admin beserta list datanya
    public function index()
    {
        $faqs = Faq::orderBy('sort_order', 'asc')->get();
        return view('admin.konten_faq', compact('faqs'));
    }

    // Menyimpan FAQ Baru
    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
            'status' => 'required|in:aktif,nonaktif',
            'sort_order' => 'required|integer',
        ]);

        Faq::create($request->all());

        return redirect()->back()->with('success', 'FAQ berhasil ditambahkan!');
    }

    // Menampilkan halaman form edit FAQ
    public function edit($id)
    {
        $faq = Faq::findOrFail($id);
        return view('admin.konten_faq_edit', compact('faq'));
    }

    // Memperbarui data FAQ
    public function update(Request $request, $id)
    {
        $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
            'status' => 'required|in:aktif,nonaktif',
            'sort_order' => 'required|integer',
        ]);

        $faq = Faq::findOrFail($id);
        $faq->update($request->all());

        return redirect('/admin/konten/faq')->with('success', 'FAQ berhasil diperbarui!');
    }

    // Menghapus data FAQ
    public function destroy($id)
    {
        $faq = Faq::findOrFail($id);
        $faq->delete();

        return redirect()->back()->with('success', 'FAQ berhasil dihapus!');
    }
}
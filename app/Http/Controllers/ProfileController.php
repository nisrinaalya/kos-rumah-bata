<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\PengajuanSewa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function getProfile()
    {
        return view('profile');
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'nama'           => 'required|string|max:255',
            'email'          => 'required|email|unique:users,email,' . Auth::id(),
            'no_hp'          => 'required|numeric',
            'jenis_kelamin'  => 'required|in:Perempuan,Laki-laki',
            'alamat'         => 'required|string',
            'kontak_darurat' => 'required|numeric',
            'ktp_dokumen'    => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:3072',
            'surat_komitmen' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:3072',
        ]);

        $user = User::findOrFail(Auth::id());

        $data = [
            'nama'           => $request->nama,
            'email'          => $request->email,
            'no_hp'          => $request->no_hp,
            'jenis_kelamin'  => $request->jenis_kelamin,
            'alamat'         => $request->alamat,
            'kontak_darurat' => $request->kontak_darurat,
        ];

        if ($request->hasFile('ktp_dokumen')) {
            if ($user->ktp_dokumen) {
                $oldKtpPath = public_path($user->ktp_dokumen);
                if (File::exists($oldKtpPath)) {
                    File::delete($oldKtpPath);
                }
            }

            $fileKtp = $request->file('ktp_dokumen');
            $ktpName = time() . '-ktp.' . $fileKtp->getClientOriginalExtension();
            $fileKtp->move(public_path('documents/ktp'), $ktpName);
            $data['ktp_dokumen'] = '/documents/ktp/' . $ktpName;
        }

        if ($request->hasFile('surat_komitmen')) {
            if ($user->surat_komitmen) {
                $oldSuratPath = public_path($user->surat_komitmen);
                if (File::exists($oldSuratPath)) {
                    File::delete($oldSuratPath);
                }
            }

            $fileSurat = $request->file('surat_komitmen');
            $suratName = time() . '-komitmen.' . $fileSurat->getClientOriginalExtension();
            $fileSurat->move(public_path('documents/surat_komitmen'), $suratName);
            $data['surat_komitmen'] = '/documents/surat_komitmen/' . $suratName;
        }

        $user->update($data);

        return back()->with('success', 'Profil berhasil diperbarui!');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current'  => 'required',
            'password' => 'required|min:6',
            'confirm'  => 'required'
        ]);

        if (!Hash::check($request->current, Auth::user()->password)) {
            return back()->with('error', 'Password saat ini salah!');
        }

        if ($request->password != $request->confirm) {
            return back()->with('error', 'Password dan Konfirmasi tidak cocok!');
        }

        $user = User::where('id', Auth::user()->id)->first();

        $user->update([
            'password' => bcrypt($request->password)
        ]);

        return back()->with('success', 'Password berhasil diperbarui!');
    }

    public function statusPembayaran()
    {
        $riwayatSewa = PengajuanSewa::where('user_id', Auth::id())
            ->with(['kamar', 'pembayarans' => function($query) {
                $query->orderBy('created_at', 'desc');
            }])
            ->orderBy('id', 'desc')
            ->get();

        return view('status-pembayaran', compact('riwayatSewa'));
    }
}

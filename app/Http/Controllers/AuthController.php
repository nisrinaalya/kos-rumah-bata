<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function getRegister()
    {
        return view('register');
    }

    public function postRegister(Request $request)
    {
        if($request->confirm != $request->password) {
            return back()->with('error', 'Password dan Konfirmasi tidak cocok!');
        }

        if(!$request->nama && !$request->email && !$request->no_hp && !$request->password) {
            return back()->with('error', 'Nama lengkap, Email, No. Telepon dan Password tidak boleh kosong!');
        }

        $user = User::where('email', $request->email)->first();

        if($user) {
            return back()->with('error', 'Email sudah terdaftar!');
        }

        User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'password' => bcrypt($request->password)
        ]);

        return redirect('/login')->with('success', 'Akun berhasil dibuat!');
    }

    public function getLogin()
    {
        return view('login');
    }

    public function postLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        if(!$user) {
            return back()->with('error', 'Email tidak ditemukan!');
        }

        if(!Hash::check($request->password, $user->password)) {
            return back()->with('error', 'Password salah!');
        }

        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if(Auth::guard('web')->attempt($credentials)) {
            $request->session()->regenerate();

            if($request->user()->role == 'admin') {
                return redirect('/admin')->with('success', 'Berhasil Login Admin!');
            } else {
                return redirect()->intended('/')->with('success', 'Berhasil Login!');
            }
        }

        return back()->with('error', 'Email atau Password salah!');
    }

    public function getLogout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Berhasil Logout!');
    }
}

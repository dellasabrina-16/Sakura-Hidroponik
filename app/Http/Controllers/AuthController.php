<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    // Menampilkan form login (admin/login.blade.php)
    public function showLoginForm()
    {
        return view('admin.login');
    }

    // Proses login
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $remember = $request->has('remember');

        if (Auth::attempt($credentials, $remember)) {

            if (!$remember) {
                // ✅ Session hanya berlaku sampai browser ditutup total
                config(['session.expire_on_close' => true]);
                // ✅ Batas waktu session bisa dibuat pendek
                config(['session.lifetime' => 1]); // expired dalam 1 menit idle
            } else {
                // ✅ Jika Remember Me → simpan sampai waktu lifetime default (120 menit atau lebih)
                config(['session.expire_on_close' => false]);
                config(['session.lifetime' => 120]);
            }

            $request->session()->regenerate();

            if (Auth::user()->role === 'admin') {
                return redirect()->intended('/admin/dashboard');
            }

            Auth::logout();
            return back()->withErrors(['email' => 'Hanya admin yang bisa login']);
        }

        return back()->withErrors(['email' => 'Email atau password salah']);
    }



    // Dashboard admin (admin/dashboard.blade.php)
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}

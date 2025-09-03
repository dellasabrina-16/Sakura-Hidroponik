<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Menampilkan form login (admin/login.blade.php)
    public function showLoginForm() {
        return view('admin.login');
    }

    // Proses login
    public function login(Request $request) {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
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
    public function dashboard() {
        return view('admin.dashboard');
    }

    // Logout
    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
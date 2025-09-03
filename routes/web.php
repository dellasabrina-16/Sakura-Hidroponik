<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('customer.pelanggan');
});


// Login Route
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin Route
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AuthController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/produk', fn() => view('admin.produk'));
    Route::get('/admin/stok', fn() => view('admin.stok'));
    Route::get('/admin/pesanan', fn() => view('admin.pesananmasuk'));
    Route::get('/admin/pesananselesai', fn() => view('admin.pesananselesai'));
});



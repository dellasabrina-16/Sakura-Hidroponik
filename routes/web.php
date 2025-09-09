<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\StokController;
use App\Http\Controllers\PesananController;


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

    // Route::get('/admin/produk', fn() => view('admin.produk'));
    Route::get('/admin/produk', [ProdukController::class, 'index'])->name('produk.index');
    Route::get('/admin/produk/create', [ProdukController::class, 'create'])->name('produk.create');
    Route::post('/admin/produk', [ProdukController::class, 'store'])->name('produk.store');
    Route::get('/admin/produk/{id}', [ProdukController::class, 'show'])->name('produk.show');
    Route::get('/admin/produk/{id}/edit', [ProdukController::class, 'edit'])->name('produk.edit');
    Route::put('/admin/produk/{id}', [ProdukController::class, 'update'])->name('produk.update');
    Route::delete('/admin/produk/{id}', [ProdukController::class, 'destroy'])->name('produk.destroy');

    // Route::get('/admin/stok', fn() => view('admin.stok'));
    Route::get('/admin/stok', [StokController::class, 'index'])->name('stok.index');
    Route::put('/admin/stok/{id}', [StokController::class, 'update'])->name('stok.update');

    // Route::get('/admin/pesanan', fn() => view('admin.pesananmasuk'));
    Route::get('/admin/pesanan', [PesananController::class, 'index'])->name('pesanan.index');
    Route::post('/admin/pesanan', [PesananController::class, 'store'])->name('pesanan.store');
    Route::post('/admin/pesanan/{id}/update-status', [PesananController::class, 'updateStatus'])->name('pesanan.updateStatus');


    Route::get('/admin/pesananselesai', fn() => view('admin.pesananselesai'));
    Route::get('/admin/laporan/mingguan', fn() => view('admin.laporanmingguan'));
    Route::get('/admin/laporan/bulanan', fn() => view('admin.laporanbulanan'));
    Route::get('/admin/laporan/tahunan', fn() => view('admin.laporantahunan'));
});

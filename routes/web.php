<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('customer.pelanggan');
});

Route::get('/dashboard', function () {
    return view('admin.dashboard');
});

Route::get('/pesananmasuk', function () {
    return view('admin.pesananmasuk');
});

Route::get('/produk', function () {
    return view('admin.produk');
});

Route::get('/pesananselesai', function () {
    return view('admin.pesananselesai');
});

Route::get('/stok', function () {
    return view('admin.stok');
});

Route::get('/login', function () {
    return view('login');
});


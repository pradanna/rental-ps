<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Route::get('/sewaps', function () {
    return view('sewaps');
});

Route::get('/bayar', function () {
    return view('bayar');
});

Route::get('/bayar', function () {
    return view('bayar');
});

Route::get('/daftar', function () {
    return view('daftar');
});

Route::get('/admin', function () {
    return view('admin.dashboard');
});

Route::get('/admin/kategori', function () {
    return view('admin.kategori');
});

Route::get('/admin/barang', function () {
    return view('admin.barang');
});

Route::get('/admin/pesanan', function () {
    return view('admin.pesanan');
});

Route::get('/admin/detailpesanan', function () {
    return view('admin.detailpesanan');
});

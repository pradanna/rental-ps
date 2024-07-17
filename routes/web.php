<?php

use App\Http\Controllers\PdfController;
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

Route::get('/', [\App\Http\Controllers\Customer\HomeController::class, 'index'])->name('customer.home');

Route::match(['post', 'get'],'/login', [\App\Http\Controllers\AuthController::class, 'login'])->name('login');

Route::get('/sewaps', function () {
    return view('sewaps');
});


Route::get('/bayar', function () {
    return view('bayar');
});

Route::get('/daftar', function () {
    return view('daftar');
});

Route::group(['prefix' => 'admin'], function () {
    Route::get('/', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard');

    Route::group(['prefix' => 'kategori'], function (){
        Route::get('/', [\App\Http\Controllers\Admin\CategoryController::class, 'index'])->name('admin.category');
    });
});

//Route::get('/admin', function () {
//    return view('admin.dashboard');
//});
//
//Route::get('/admin/kategori', function () {
//    return view('admin.kategori');
//});
//
//Route::get('/admin/barang', function () {
//    return view('admin.barang');
//});
//
//Route::get('/admin/pesanan', function () {
//    return view('admin.pesanan');
//});
//
//Route::get('/admin/detailpesanan', function () {
//    return view('admin.detailpesanan');
//});
//
//Route::get('/admin/buktiterima', [PdfController::class, 'generatePdf']);

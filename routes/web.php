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
Route::match(['post', 'get'],'/register', [\App\Http\Controllers\AuthController::class, 'register'])->name('register');
Route::get('/logout', [\App\Http\Controllers\AuthController::class, 'logout'])->name('logout');

Route::get('/{id}/product', [\App\Http\Controllers\Customer\ProductController::class,'index'])->name('customer.product');
Route::match(['post', 'get'],'/{id}/product/{product_id}', [\App\Http\Controllers\Customer\ProductController::class,'detail'])->name('customer.product.detail');

Route::match(['post', 'get'], '/keranjang', [\App\Http\Controllers\Customer\KeranjangController::class, 'index'])->name('customer.keranjang');
Route::post( '/keranjang/{id}/delete', [\App\Http\Controllers\Customer\KeranjangController::class, 'destroy'])->name('customer.keranjang.delete');

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
        Route::match(['post', 'get'],'/add', [\App\Http\Controllers\Admin\CategoryController::class, 'add'])->name('admin.category.add');
        Route::match(['post', 'get'],'/{id}/edit', [\App\Http\Controllers\Admin\CategoryController::class, 'edit'])->name('admin.category.edit');
        Route::post('/{id}/delete', [\App\Http\Controllers\Admin\CategoryController::class, 'delete'])->name('admin.category.delete');
    });

    Route::group(['prefix' => 'barang'], function (){
        Route::match(['post', 'get'],'/', [\App\Http\Controllers\Admin\UnitController::class, 'index'])->name('admin.barang');
        Route::match(['post', 'get'],'/add', [\App\Http\Controllers\Admin\UnitController::class, 'add'])->name('admin.barang.add');
        Route::match(['post', 'get'],'/{id}/edit', [\App\Http\Controllers\Admin\UnitController::class, 'edit'])->name('admin.barang.edit');
        Route::post('/{id}/delete', [\App\Http\Controllers\Admin\UnitController::class, 'delete'])->name('admin.barang.delete');
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

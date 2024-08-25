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

Route::match(['post', 'get'], '/login', [\App\Http\Controllers\AuthController::class, 'login'])->name('login');
Route::match(['post', 'get'], '/register', [\App\Http\Controllers\AuthController::class, 'register'])->name('register');
Route::get('/logout', [\App\Http\Controllers\AuthController::class, 'logout'])->name('logout');

Route::get('/{id}/product', [\App\Http\Controllers\Customer\ProductController::class, 'index'])->name('customer.product');
Route::match(['post', 'get'], '/{id}/product/{product_id}', [\App\Http\Controllers\Customer\ProductController::class, 'detail'])->name('customer.product.detail');

Route::group(['prefix' => 'keranjang'], function () {
    Route::match(['post', 'get'], '/', [\App\Http\Controllers\Customer\KeranjangController::class, 'index'])->name('customer.keranjang');
    Route::post('/{id}/delete', [\App\Http\Controllers\Customer\KeranjangController::class, 'destroy'])->name('customer.keranjang.delete');
    Route::post('/checkout', [\App\Http\Controllers\Customer\KeranjangController::class, 'checkout'])->name('customer.keranjang.checkout');

});

Route::group(['prefix' => 'transaksi'], function () {
    Route::get('/', [\App\Http\Controllers\Customer\PeminjamanController::class, 'index'])->name('customer.transaction');
    Route::get('/{id}', [\App\Http\Controllers\Customer\PeminjamanController::class, 'detail'])->name('customer.transaction.detail');
    Route::match(['post', 'get'], '/{id}/pembayaran', [\App\Http\Controllers\Customer\PembayaranController::class, 'index'])->name('customer.transaction.payment');
});

Route::get('/bayar', function () {
    return view('bayar');
});

Route::get('/daftar', function () {
    return view('daftar');
});

Route::group(['prefix' => 'admin'], function () {
    Route::get('/', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard');

    Route::group(['prefix' => 'member'], function () {
        Route::get('/', [\App\Http\Controllers\Admin\MemberController::class, 'index'])->name('admin.member');
    });

    Route::group(['prefix' => 'pengguna'], function () {
        Route::get('/', [\App\Http\Controllers\Admin\PenggunaController::class, 'index'])->name('admin.pengguna');
        Route::match(['post', 'get'], '/add', [\App\Http\Controllers\Admin\PenggunaController::class, 'add'])->name('admin.pengguna.add');
        Route::match(['post', 'get'], '/{id}/edit', [\App\Http\Controllers\Admin\PenggunaController::class, 'edit'])->name('admin.pengguna.edit');
        Route::post('/{id}/delete', [\App\Http\Controllers\Admin\PenggunaController::class, 'delete'])->name('admin.pengguna.delete');
    });

    Route::group(['prefix' => 'kategori'], function () {
        Route::get('/', [\App\Http\Controllers\Admin\CategoryController::class, 'index'])->name('admin.category');
        Route::match(['post', 'get'], '/add', [\App\Http\Controllers\Admin\CategoryController::class, 'add'])->name('admin.category.add');
        Route::match(['post', 'get'], '/{id}/edit', [\App\Http\Controllers\Admin\CategoryController::class, 'edit'])->name('admin.category.edit');
        Route::post('/{id}/delete', [\App\Http\Controllers\Admin\CategoryController::class, 'delete'])->name('admin.category.delete');
    });

    Route::group(['prefix' => 'barang'], function () {
        Route::match(['post', 'get'], '/', [\App\Http\Controllers\Admin\UnitController::class, 'index'])->name('admin.barang');
        Route::match(['post', 'get'], '/add', [\App\Http\Controllers\Admin\UnitController::class, 'add'])->name('admin.barang.add');
        Route::match(['post', 'get'], '/{id}/edit', [\App\Http\Controllers\Admin\UnitController::class, 'edit'])->name('admin.barang.edit');
        Route::post('/{id}/delete', [\App\Http\Controllers\Admin\UnitController::class, 'delete'])->name('admin.barang.delete');
    });

    Route::group(['prefix' => 'peminjaman'], function () {
        Route::get('/', [\App\Http\Controllers\Admin\PeminjamanController::class, 'index'])->name('admin.transaction');
        Route::match(['post', 'get'], '/{id}/peminjaman-baru', [\App\Http\Controllers\Admin\PeminjamanController::class, 'detail_new'])->name('admin.transaction.new');
        Route::match(['post', 'get'], '/{id}/siap-diambil', [\App\Http\Controllers\Admin\PeminjamanController::class, 'detail_ready'])->name('admin.transaction.ready');
        Route::match(['post', 'get'], '/{id}/peminjaman-proses', [\App\Http\Controllers\Admin\PeminjamanController::class, 'detail_process'])->name('admin.transaction.process');
        Route::match(['post', 'get'], '/{id}/peminjaman-selesai', [\App\Http\Controllers\Admin\PeminjamanController::class, 'detail_finish'])->name('admin.transaction.finish');
        Route::match(['post', 'get'], '/{id}/peminjaman-selesai/cetak', [\App\Http\Controllers\Admin\PeminjamanController::class, 'nota'])->name('admin.transaction.finish.nota');
    });
    Route::group(['prefix' => 'laporan'], function () {
        Route::get('/', [\App\Http\Controllers\Admin\ReportController::class, 'index'])->name('admin.report');
        Route::get('/cetak', [\App\Http\Controllers\Admin\ReportController::class, 'pdf'])->name('admin.report.print');
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
//Route::get('/admin/peminjaman', function () {
//    return view('admin.peminjaman');
//});
//
//Route::get('/admin/detailpesanan', function () {
//    return view('admin.detailpesanan');
//});
//
//Route::get('/admin/buktiterima', [PdfController::class, 'generatePdf']);

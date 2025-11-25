<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

// USER
Route::get('/', [HomeController::class, 'index']);
Route::get('/produk/{id}', [App\Http\Controllers\ProdukController::class, 'detail_produk'])->name('produk.detail');

// ADMIN
Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('produk', App\Http\Controllers\Admin\ProdukController::class);
    Route::resource('kategori', App\Http\Controllers\Admin\KategoriController::class);
});

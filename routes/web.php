<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index']);

Route::get('/admin/produk', [App\Http\Controllers\Admin\ProdukController::class, 'index']);
Route::resource('produk', App\Http\Controllers\Admin\ProdukController::class);
Route::get('/admin/kategori', [App\Http\Controllers\Admin\KategoriController::class, 'index']);
Route::resource('kategori', App\Http\Controllers\Admin\KategoriController::class);
Route::prefix('admin')->name('admin.')->group(function() {
    Route::resource('kategori', App\Http\Controllers\Admin\KategoriController::class);
    Route::resource('produk', App\Http\Controllers\Admin\ProdukController::class);
});

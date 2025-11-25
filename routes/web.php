<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginUserController;
use App\Http\Controllers\Admin\LoginAdminController;
use App\Http\Controllers\Admin\AdminController;

// USER ROUTES
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/produk/{id}', [App\Http\Controllers\ProdukController::class, 'detail_produk'])->name('produk.detail');

// USER AUTH ROUTES
Route::get('/login', [LoginUserController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginUserController::class, 'login']);
Route::get('/register', [LoginUserController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [LoginUserController::class, 'register']);
Route::post('/logout', [LoginUserController::class, 'logout'])->name('logout');

// ADMIN AUTH ROUTES
Route::get('/admin/login', [LoginAdminController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [LoginAdminController::class, 'login']);
Route::post('/admin/logout', [LoginAdminController::class, 'logout'])->name('admin.logout');

// ADMIN ROUTES (dengan pengecekan session)
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');
    Route::resource('produk', App\Http\Controllers\Admin\ProdukController::class);
    Route::resource('kategori', App\Http\Controllers\Admin\KategoriController::class);
});

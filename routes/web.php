<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\LoginUserController;
use App\Http\Controllers\User\ProdukController;
use App\Http\Controllers\User\KeranjangController;
use App\Http\Controllers\User\CheckoutController;
use App\Http\Controllers\User\PesananController;
use App\Http\Controllers\Admin\LoginAdminController;
use App\Http\Controllers\Admin\AdminController;

// USER ROUTES
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/produk/{id}', [ProdukController::class, 'detail_produk'])->name('produk.detail');

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

// KERANJANG ROUTES (harus login)
Route::get('/keranjang', [KeranjangController::class, 'index'])->name('keranjang.index');
Route::post('/keranjang', [KeranjangController::class, 'store'])->name('keranjang.store');
Route::put('/keranjang/{id}', [KeranjangController::class, 'update'])->name('keranjang.update');
Route::delete('/keranjang/{id}', [KeranjangController::class, 'destroy'])->name('keranjang.destroy');
Route::post('/keranjang/clear', [KeranjangController::class, 'clear'])->name('keranjang.clear');

// CHECKOUT ROUTES (harus login)
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');

// USER PESANAN ROUTES (harus login)
Route::get('/pesanan', [PesananController::class, 'index'])->name('user.pesanan');

// ADMIN ROUTES (dengan pengecekan session)
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');
    Route::resource('produk', App\Http\Controllers\Admin\ProdukController::class);
    Route::resource('kategori', App\Http\Controllers\Admin\KategoriController::class);
    Route::get('pesanan', [App\Http\Controllers\Admin\PesananController::class, 'index'])->name('pesanan.index');
    Route::post('pesanan/{id}/update-status', [App\Http\Controllers\Admin\PesananController::class, 'updateStatus'])->name('pesanan.updateStatus');
});

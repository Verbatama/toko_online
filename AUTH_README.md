# Sistem Autentikasi Tanpa Middleware - Toko Online

## Deskripsi
Sistem autentikasi sederhana dengan role **User** dan **Admin** tanpa menggunakan middleware Laravel. Sistem ini dibuat untuk pembelajaran, menggunakan session manual untuk pengecekan autentikasi.

## Struktur Sistem

### Controllers

1. **LoginUserController** (`app/Http/Controllers/LoginUserController.php`)
   - `showLoginForm()` - Menampilkan form login user
   - `login()` - Proses login user (role: user)
   - `logout()` - Logout user
   - `showRegisterForm()` - Menampilkan form register
   - `register()` - Proses register user baru

2. **LoginAdminController** (`app/Http/Controllers/Admin/LoginAdminController.php`)
   - `showLoginForm()` - Menampilkan form login admin
   - `login()` - Proses login admin (role: admin)
   - `logout()` - Logout admin

3. **AdminController** (`app/Http/Controllers/Admin/AdminController.php`)
   - `checkAdminAuth()` - Method private untuk cek autentikasi admin
   - `index()` - Dashboard admin

### Routes

```php
// User Routes
GET  /                  -> Home (bisa diakses guest atau user login)
GET  /login             -> Form login user
POST /login             -> Proses login user
GET  /register          -> Form register user
POST /register          -> Proses register user
POST /logout            -> Logout user

// Admin Routes
GET  /admin/login       -> Form login admin
POST /admin/login       -> Proses login admin
POST /admin/logout      -> Logout admin
GET  /admin             -> Dashboard admin (harus login)
GET  /admin/produk      -> Kelola produk (harus login)
GET  /admin/kategori    -> Kelola kategori (harus login)
```

## Cara Kerja Autentikasi

### User Authentication
1. User login melalui `/login` dengan username (nama) dan password
2. Sistem mengecek apakah username ada di database dengan role 'user'
3. Jika valid, data user disimpan ke session:
   ```php
   session([
       'user_id' => $user->id,
       'user_name' => $user->nama,
       'user_email' => $user->email,
       'user_role' => $user->role
   ]);
   ```
4. Redirect ke home `/`

### Admin Authentication
1. Admin login melalui `/admin/login` dengan username (nama) dan password
2. Sistem mengecek apakah username ada di database dengan role 'admin'
3. Jika valid, data admin disimpan ke session
4. Redirect ke admin dashboard `/admin`

### Pengecekan Manual (Tanpa Middleware)
Setiap controller admin memiliki method `checkAdminAuth()`:
```php
private function checkAdminAuth()
{
    if (!session('user_id')) {
        return redirect('/admin/login')->with('error', 'Silakan login terlebih dahulu!');
    }

    $user = User::find(session('user_id'));
    
    if (!$user || $user->role !== 'admin') {
        session()->flush();
        return redirect('/admin/login')->with('error', 'Akses ditolak!');
    }

    return null;
}
```

Method ini dipanggil di setiap method yang memerlukan autentikasi admin.

## Akun Testing

Setelah menjalankan `php artisan db:seed`, akan dibuat 2 akun:

### Admin
- **Username**: Admin
- **Password**: admin123
- **Email**: admin@toko.com
- **Akses**: `/admin` (Dashboard admin, kelola produk & kategori)

### User
- **Username**: User Test
- **Password**: user123
- **Email**: user@toko.com
- **Akses**: `/` (Home, dapat login/guest)

## Alur Penggunaan

### Sebagai Guest (Tidak Login)
1. Akses `/`
2. Dapat melihat produk
3. Navbar menampilkan: Login | Register

### Sebagai User (Login)
1. Akses `/login`
2. Login dengan username: "User Test", password: user123
3. Redirect ke home `/`
4. Navbar menampilkan: Halo, [nama] | Logout

### Sebagai Admin (Login)
1. Akses `/admin/login`
2. Login dengan username: "Admin", password: admin123
3. Redirect ke admin dashboard `/admin`
4. Dapat akses: Dashboard | Produk | Kategori
5. Navbar menampilkan: Admin: [nama] | Logout

## Fitur Keamanan

1. **Password Hashing**: Menggunakan `Hash::make()` dan `Hash::check()`
2. **Role Separation**: User tidak bisa akses admin panel, admin tidak bisa login sebagai user
3. **Session Validation**: Setiap request ke admin panel dicek session-nya
4. **Auto Logout**: Jika role tidak sesuai, session akan di-flush
5. **Redirect Protection**: User yang belum login akan diredirect ke login page

## Perbedaan dengan Middleware

### Tanpa Middleware (Sistem Ini)
- ✅ Lebih eksplisit dan mudah dipahami untuk pemula
- ✅ Kontrol penuh di setiap controller
- ❌ Harus menulis pengecekan di setiap method
- ❌ Code repetition (DRY principle tidak optimal)

### Dengan Middleware
- ✅ Code lebih clean dan reusable
- ✅ Separation of concerns
- ✅ Mudah di-maintain untuk aplikasi besar
- ❌ Lebih abstrak, butuh pemahaman lebih dalam

## Pengembangan Lebih Lanjut

Untuk production, disarankan:
1. Gunakan middleware Laravel (`auth`, custom role middleware)
2. Implementasi CSRF protection yang lebih baik
3. Tambahkan rate limiting untuk login
4. Implementasi remember token
5. Gunakan Laravel Sanctum/Passport untuk API

## Testing

1. Test login user:
   ```
   Username: User Test
   Password: user123
   Expected: Redirect ke /
   ```

2. Test login admin:
   ```
   Username: Admin
   Password: admin123
   Expected: Redirect ke /admin
   ```

3. Test akses admin tanpa login:
   ```
   Akses: /admin
   Expected: Redirect ke /admin/login dengan pesan error
   ```

4. Test user coba akses admin:
   ```
   Login sebagai user, lalu akses /admin/login
   Expected: Redirect ke /
   ```

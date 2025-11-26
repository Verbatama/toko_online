<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginAdminController extends Controller
{
    // Tampilkan form login admin
    public function showLoginForm()
    {
        // Jika sudah login sebagai admin, redirect ke admin panel
        if (session('admin_user_id') && session('admin_user_role') === 'admin') {
            return redirect('/admin');
        }
        
        return view('admin.login');
    }

    // Proses login admin
    public function login(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'password' => 'required',
        ]);

        // Cari user berdasarkan nama (username) dan pastikan role adalah admin
        $user = User::where('nama', $request->nama)
                    ->where('role', 'admin')
                    ->first();

        // Cek apakah user ada dan password benar
        if ($user && Hash::check($request->password, $user->password)) {
            // Simpan data admin ke session dengan prefix 'admin_'
            session([
                'admin_user_id' => $user->id,
                'admin_user_name' => $user->nama,
                'admin_user_email' => $user->email,
                'admin_user_role' => $user->role
            ]);

            return redirect('/admin')->with('success', 'Login admin berhasil!');
        }

        return back()->withErrors([
            'nama' => 'Username atau password salah.',
        ])->withInput();
    }

    // Logout admin
    public function logout()
    {
        session()->forget(['admin_user_id', 'admin_user_name', 'admin_user_email', 'admin_user_role']);
        return redirect('/admin/login')->with('success', 'Logout berhasil!');
    }
}

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
        if (session('user_id')) {
            $user = User::find(session('user_id'));
            if ($user && $user->role === 'admin') {
                return redirect('/admin');
            }
            // Jika login sebagai user, redirect ke home
            return redirect('/')->with('error', 'Akses ditolak');
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
            // Simpan data admin ke session
            session([
                'user_id' => $user->id,
                'user_name' => $user->nama,
                'user_email' => $user->email,
                'user_role' => $user->role
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
        session()->flush();
        return redirect('/admin/login')->with('success', 'Logout berhasil!');
    }
}

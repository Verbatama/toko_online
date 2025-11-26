<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class LoginUserController extends Controller
{
    // Tampilkan form login
    public function showLoginForm()
    {
        // Jika sudah login, redirect sesuai role
        if (session('user_id')) {
            $user = User::find(session('user_id'));
            if ($user && $user->role === 'admin') {
                return redirect('/admin');
            }
            return redirect('/');
        }
        
        return view('auth.login');
    }

    // Proses login
    public function login(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'password' => 'required',
        ]);

        // Cari user berdasarkan nama (username) dan pastikan role adalah user
        $user = User::where('nama', $request->nama)
                    ->where('role', 'user')
                    ->first();

        // Cek apakah user ada dan password benar
        if ($user && Hash::check($request->password, $user->password)) {
            // Simpan data user ke session
            session([
                'user_id' => $user->id,
                'user_name' => $user->nama,
                'user_email' => $user->email,
                'user_role' => $user->role
            ]);

            return redirect('/')->with('success', 'Login berhasil!');
        }

        return back()->withErrors([
            'nama' => 'Username atau password salah.',
        ])->withInput();
    }

    // Logout
    public function logout()
    {
        session()->flush();
        return redirect('/')->with('success', 'Logout berhasil!');
    }

    // Tampilkan form register
    public function showRegisterForm()
    {
        if (session('user_id')) {
            return redirect('/');
        }
        
        return view('auth.register');
    }

    // Proses register
    public function register(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255|unique:users,nama',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user', // Default role adalah user
        ]);

        // Auto login setelah register
        // session([
        //     'user_id' => $user->id,
        //     'user_name' => $user->nama,
        //     'user_email' => $user->email,
        //     'user_role' => $user->role
        // ]);

        return redirect('/')->with('success', 'Registrasi berhasil!');
    }
}

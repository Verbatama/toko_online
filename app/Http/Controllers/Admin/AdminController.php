<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Method untuk mengecek apakah user sudah login sebagai admin
    private function checkAdminAuth()
    {
        if (!session('user_id')) {
            return redirect('/admin/login')->with('error', 'Silakan login terlebih dahulu!');
        }

        $user = User::find(session('user_id'));
        
        if (!$user || $user->role !== 'admin') {
            session()->flush();
            return redirect('/admin/login')->with('error', 'Akses ditolak! Hanya admin yang bisa mengakses halaman ini.');
        }

        return null; // Return null jika sudah login sebagai admin
    }

    // Dashboard admin
    public function index()
    {
        // Cek autentikasi admin
        $authCheck = $this->checkAdminAuth();
        if ($authCheck) {
            return $authCheck;
        }

        // Ambil data user admin dari session
        $admin = User::find(session('user_id'));

        return view('admin.dashboard', compact('admin'));
    }
}

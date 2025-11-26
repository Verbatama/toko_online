<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pesanan;
use App\Models\User;
use Illuminate\Http\Request;

class PesananController extends Controller
{
    public function index()
    {
        // Cek apakah user adalah admin
        if (!session('admin_user_id')) {
            return redirect('/admin/login');
        }

        $user = User::find(session('admin_user_id'));
        if (!$user || $user->role !== 'admin') {
            return redirect('/')->with('error', 'Akses ditolak');
        }

        // Ambil semua pesanan dengan relasi user dan produk
        $pesanans = Pesanan::with(['user', 'produk'])
            ->orderBy('created_at', 'desc')
            ->get();

        // Hitung statistik
        $stats = [
            'pending' => Pesanan::where('status', 'pending')->count(),
            'dikirim' => Pesanan::where('status', 'dikirim')->count(),
            'selesai' => Pesanan::where('status', 'selesai')->count(),
            'total' => Pesanan::count(),
        ];

        return view('admin.pesanan.index', compact('pesanans', 'stats'));
    }

    public function updateStatus(Request $request, $id)
    {
        // Cek apakah user adalah admin
        if (!session('admin_user_id')) {
            return redirect('/admin/login');
        }

        $user = User::find(session('admin_user_id'));
        if (!$user || $user->role !== 'admin') {
            return redirect('/')->with('error', 'Akses ditolak');
        }

        $pesanan = Pesanan::findOrFail($id);
        $pesanan->status = $request->status;
        $pesanan->save();

        return redirect()->route('admin.pesanan.index')
            ->with('success', 'Status pesanan berhasil diupdate!');
    }
}

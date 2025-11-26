<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Pesanan;
use Illuminate\Http\Request;

class PesananController extends Controller
{
    public function index()
    {
        // Pastikan user sudah login
        if (!session('logged_user_id') || session('logged_user_role') !== 'user') {
            return redirect('/login')->with('error', 'Silakan login terlebih dahulu');
        }

        $userId = session('logged_user_id');

        // Ambil semua pesanan user
        $pesanans = Pesanan::where('user_id', $userId)
            ->with('produk')
            ->orderBy('created_at', 'desc')
            ->get();

        // Hitung statistik
        $stats = [
            'pending' => Pesanan::where('user_id', $userId)->where('status', 'pending')->count(),
            'dikirim' => Pesanan::where('user_id', $userId)->where('status', 'dikirim')->count(),
            'selesai' => Pesanan::where('user_id', $userId)->where('status', 'selesai')->count(),
        ];

        return view('user.detail_pesanan', compact('pesanans', 'stats'));
    }
}

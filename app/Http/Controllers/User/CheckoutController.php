<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Keranjang;
use App\Models\Pesanan;
use App\Models\Produk;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        // Cek login
        if (!session('logged_user_id') || session('logged_user_role') !== 'user') {
            return redirect('/login')->with('error', 'Silakan login terlebih dahulu');
        }

        // Ambil keranjang user
        $keranjangs = Keranjang::where('user_id', session('logged_user_id'))
            ->with('produk')
            ->get();

        if ($keranjangs->isEmpty()) {
            return redirect()->route('keranjang.index')
                ->with('error', 'Keranjang Anda kosong');
        }

        // Hitung total
        $total = 0;
        foreach ($keranjangs as $item) {
            $total += $item->produk->harga_produk * $item->jumlah;
        }

        return view('user.checkout', compact('keranjangs', 'total'));
    }

    public function store(Request $request)
    {
        // Cek login
        if (!session('logged_user_id') || session('logged_user_role') !== 'user') {
            return redirect('/login')->with('error', 'Silakan login terlebih dahulu');
        }

        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
        ]);

        // Ambil keranjang user
        $keranjangs = Keranjang::where('user_id', session('logged_user_id'))
            ->with('produk')
            ->get();

        if ($keranjangs->isEmpty()) {
            return redirect()->route('keranjang.index')
                ->with('error', 'Keranjang Anda kosong');
        }

        // Proses setiap item di keranjang menjadi pesanan
        foreach ($keranjangs as $item) {
            // Cek stok
            $produk = Produk::find($item->produk_id);
            if ($produk->stok_produk < $item->jumlah) {
                return back()->with('error', 'Stok produk ' . $produk->nama_produk . ' tidak mencukupi');
            }

            // Buat pesanan
            Pesanan::create([
                'user_id' => session('logged_user_id'),
                'produk_id' => $item->produk_id,
                'jumlah_beli' => $item->jumlah,
                'nama_user' => $request->nama,
                'alamat' => $request->alamat,
                'status' => 'pending',
                'total_harga' => $produk->harga_produk * $item->jumlah,
            ]);

            // Kurangi stok produk
            $produk->stok_produk -= $item->jumlah;
            $produk->save();
        }

        // Hapus keranjang setelah checkout
        Keranjang::where('user_id', session('logged_user_id'))->delete();

        return redirect('/')->with('success', 'Pesanan berhasil dibuat! Admin akan segera memproses pesanan Anda.');
    }
}

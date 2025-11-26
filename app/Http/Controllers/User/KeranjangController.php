<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Keranjang;
use App\Models\Produk;

class KeranjangController extends Controller
{
    // Tampilkan halaman keranjang
    public function index()
    {
        // Cek apakah user sudah login
        if (!session('logged_user_id')) {
            return redirect('/login')->with('error', 'Silakan login terlebih dahulu');
        }

        // Ambil data keranjang user dengan relasi produk
        $keranjangs = Keranjang::with('produk.kategori')
            ->where('user_id', session('logged_user_id'))
            ->get();

        // Hitung total harga
        $total = $keranjangs->sum(function($keranjang) {
            return $keranjang->jumlah * $keranjang->produk->harga_produk;
        });

        return view('user.keranjang', compact('keranjangs', 'total'));
    }

    // Tambah produk ke keranjang
    public function store(Request $request)
    {
        // Cek apakah user sudah login
        if (!session('logged_user_id')) {
            return redirect('/login')->with('error', 'Silakan login terlebih dahulu');
        }

        $request->validate([
            'produk_id' => 'required|exists:produks,id',
            'jumlah' => 'required|integer|min:1',
        ]);

        // Cek stok produk
        $produk = Produk::findOrFail($request->produk_id);
        if ($produk->stok_produk < $request->jumlah) {
            return back()->with('error', 'Stok produk tidak mencukupi');
        }

        // Cek apakah produk sudah ada di keranjang
        $keranjang = Keranjang::where('user_id', session('logged_user_id'))
            ->where('produk_id', $request->produk_id)
            ->first();

        if ($keranjang) {
            // Update jumlah jika produk sudah ada
            $jumlahBaru = $keranjang->jumlah + $request->jumlah;
            
            // Cek stok lagi
            if ($produk->stok_produk < $jumlahBaru) {
                return back()->with('error', 'Stok produk tidak mencukupi');
            }
            
            $keranjang->update(['jumlah' => $jumlahBaru]);
        } else {
            // Tambah produk baru ke keranjang
            Keranjang::create([
                'user_id' => session('logged_user_id'),
                'produk_id' => $request->produk_id,
                'jumlah' => $request->jumlah,
            ]);
        }

        return redirect('/')->with('success', 'Produk berhasil ditambahkan ke keranjang');
    }

    // Update jumlah produk di keranjang
    public function update(Request $request, $id)
    {
        $request->validate([
            'jumlah' => 'required|integer|min:1',
        ]);

        $keranjang = Keranjang::where('id', $id)
            ->where('user_id', session('logged_user_id'))
            ->firstOrFail();

        // Cek stok
        if ($keranjang->produk->stok_produk < $request->jumlah) {
            return back()->with('error', 'Stok produk tidak mencukupi');
        }

        $keranjang->update(['jumlah' => $request->jumlah]);

        return back()->with('success', 'Jumlah produk berhasil diupdate');
    }

    // Hapus produk dari keranjang
    public function destroy($id)
    {
        $keranjang = Keranjang::where('id', $id)
            ->where('user_id', session('logged_user_id'))
            ->firstOrFail();

        $keranjang->delete();

        return back()->with('success', 'Produk berhasil dihapus dari keranjang');
    }

    // Hapus semua item di keranjang
    public function clear()
    {
        Keranjang::where('user_id', session('logged_user_id'))->delete();

        return back()->with('success', 'Keranjang berhasil dikosongkan');
    }
}

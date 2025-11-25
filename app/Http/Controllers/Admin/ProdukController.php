<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use App\Models\User;
use Illuminate\Http\Request;

class ProdukController extends Controller
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

        return null;
    }

    public function index()
    {
        $authCheck = $this->checkAdminAuth();
        if ($authCheck) return $authCheck;

        $produks = Produk::latest()->paginate(10);
        return view('admin.produk.index', compact('produks'));
    }

    public function create()
    {
        $authCheck = $this->checkAdminAuth();
        if ($authCheck) return $authCheck;

        $kategoris = \App\Models\Kategori::all();
        return view('admin.produk.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $authCheck = $this->checkAdminAuth();
        if ($authCheck) return $authCheck;

        $request->validate([
            'nama_produk' => 'required|max:255',
            'harga_produk' => 'required|numeric',
            'deskripsi_produk' => 'required',
            'stok_produk' => 'required|integer|min:0',
            'kategori_id' => 'required|exists:kategoris,id',
            'gambar_produk' => 'nullable|url',
        ]);

        Produk::create($request->all());

        return redirect('/admin/produk')->with('success', 'Produk berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $authCheck = $this->checkAdminAuth();
        if ($authCheck) return $authCheck;

        $produk = Produk::findOrFail($id);
        $kategoris = \App\Models\Kategori::all();
        return view('admin.produk.edit', compact('produk', 'kategoris'));
    }

    public function update(Request $request, $id)
    {
        $authCheck = $this->checkAdminAuth();
        if ($authCheck) return $authCheck;

        $produk = Produk::findOrFail($id);
        $request->validate([
            'nama_produk' => 'required|max:255',
            'harga_produk' => 'required|numeric',
            'deskripsi_produk' => 'required',
            'stok_produk' => 'required|integer|min:0',
            'kategori_id' => 'required|exists:kategoris,id',
            'gambar_produk' => 'nullable|url',
        ]);

        $produk->update($request->all());

        return redirect('/admin/produk')->with('success', 'Produk berhasil diupdate!');
    }

    public function destroy($id)
    {
        $authCheck = $this->checkAdminAuth();
        if ($authCheck) return $authCheck;

        $produk = Produk::findOrFail($id);
        $produk->delete();

        return redirect('/admin/produk')->with('success', 'Produk berhasil dihapus!');
    }
//         public function show($id)
//     {
//         $product = Produk::findOrFail($id);
//         return view('user.detail', compact('product'));
// }
     
}

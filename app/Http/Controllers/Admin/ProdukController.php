<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index()
    {
        $produks = Produk::latest()->paginate(10);
        return view('admin.produk.index', compact('produks'));
    }

    public function create()
    {
        $kategoris = \App\Models\Kategori::all();
        return view('admin.produk.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required|max:255',
            'harga_produk' => 'required|numeric',
            'deskripsi_produk' => 'required',
            'stok_produk' => 'required|integer|min:0',
            'kategori_id' => 'required|exists:kategoris,id',
        ]);

        Produk::create($request->all());

        return redirect('/admin/produk')->with('success', 'Produk berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $produk = Produk::findOrFail($id);
        $kategoris = \App\Models\Kategori::all();
        return view('admin.produk.edit', compact('produk', 'kategoris'));
    }

    public function update(Request $request, $id)
    {
        $produk = Produk::findOrFail($id);
        $request->validate([
            'nama_produk' => 'required|max:255',
            'harga_produk' => 'required|numeric',
            'deskripsi_produk' => 'required',
            'stok_produk' => 'required|integer|min:0',
            'kategori_id' => 'required|exists:kategoris,id',
        ]);

        $produk->update($request->all());

        return redirect('/admin/produk')->with('success', 'Produk berhasil diupdate!');
    }

    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);
        $produk->delete();

        return redirect('/admin/produk')->with('success', 'Produk berhasil dihapus!');
    }
}

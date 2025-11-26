<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Produk;           

class ProdukController extends Controller
{   
    public function detail_produk($id)
    {
        $produk = Produk::findOrFail($id);
        return view('user.detail', compact('produk'));
}
            
    }
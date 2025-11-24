<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Kategori;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $produks = Produk::with('kategori')->latest()->get();
        $kategoris = Kategori::all();
        return view('index', compact('produks', 'kategoris'));
    }
}

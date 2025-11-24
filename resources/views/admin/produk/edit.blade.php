@extends('admin.layout')

@section('title', 'Edit Produk')

@section('content')
<h1>Edit Produk</h1>

<form action="{{ route('produk.update', $produk->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label>Kategori</label>
        <select name="kategori_id" class="form-control" required>
            <option value="">Pilih Kategori</option>
            @foreach($kategoris as $kategori)
            <option value="{{ $kategori->id }}" {{ $produk->kategori_id == $kategori->id ? 'selected' : '' }}>
                {{ $kategori->nama_kategori }}
            </option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label>Nama Produk</label>
        <input type="text" name="nama_produk" class="form-control" value="{{ $produk->nama_produk }}" required>
    </div>
    <div class="mb-3">
        <label>Harga Produk</label>
        <input type="number" name="harga_produk" class="form-control" step="0.01" value="{{ $produk->harga_produk }}" required>
    </div>
    <div class="mb-3">
        <label>Stok Produk</label>
        <input type="number" name="stok_produk" class="form-control" min="0" value="{{ $produk->stok_produk }}" required>
    </div>
    <div class="mb-3">
        <label>Deskripsi Produk</label>
        <textarea name="deskripsi_produk" class="form-control" rows="4" required>{{ $produk->deskripsi_produk }}</textarea>
    </div>
    <button class="btn btn-success">Update</button>
    <a href="{{ route('produk.index') }}" class="btn btn-secondary">Kembali</a>
</form>
@endsection

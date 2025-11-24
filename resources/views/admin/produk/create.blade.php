@extends('admin.layout')

@section('title', 'Tambah Produk')

@section('content')
<h1>Tambah Produk</h1>

<form action="{{ route('produk.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label>Kategori</label>
        <select name="kategori_id" class="form-control" required>
            <option value="">Pilih Kategori</option>
            @foreach($kategoris as $kategori)
            <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label>Nama Produk</label>
        <input type="text" name="nama_produk" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>URL Gambar Produk (CDN)</label>
        <input type="url" name="gambar_produk" class="form-control" placeholder="https://example.com/image.jpg">
        <small class="text-muted">Masukkan URL gambar dari CDN atau layanan hosting gambar</small>
    </div>
    <div class="mb-3">
        <label>Harga Produk</label>
        <input type="number" name="harga_produk" class="form-control" step="0.01" required>
    </div>
    <div class="mb-3">
        <label>Stok Produk</label>
        <input type="number" name="stok_produk" class="form-control" min="0" required>
    </div>
    <div class="mb-3">
        <label>Deskripsi Produk</label>
        <textarea name="deskripsi_produk" class="form-control" rows="4" required></textarea>
    </div>
    <button class="btn btn-success">Simpan</button>
    <a href="{{ route('produk.index') }}" class="btn btn-secondary">Kembali</a>
</form>
@endsection

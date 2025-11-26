@extends('admin.layout')

@section('title', 'Tambah Produk')

@section('content')
<style>
    .page-header {
        margin-bottom: 30px;
    }

    .page-header h1 {
        color: #2c3e50;
        font-size: 28px;
        font-weight: 700;
        margin: 0 0 10px 0;
    }

    .breadcrumb {
        display: flex;
        gap: 8px;
        font-size: 14px;
        color: #6c757d;
        align-items: center;
    }

    .breadcrumb a {
        color: #3498db;
        text-decoration: none;
    }

    .breadcrumb a:hover {
        text-decoration: underline;
    }

    .form-container {
        background: white;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        max-width: 800px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        font-size: 14px;
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 8px;
    }

    .form-group label .required {
        color: #e74c3c;
        margin-left: 4px;
    }

    .form-control {
        width: 100%;
        padding: 12px 16px;
        border: 2px solid #e9ecef;
        border-radius: 8px;
        font-size: 14px;
        transition: all 0.3s;
        font-family: 'Inter', sans-serif;
    }

    .form-control:focus {
        outline: none;
        border-color: #3498db;
        box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.1);
    }

    .form-control:disabled {
        background: #f8f9fa;
        cursor: not-allowed;
    }

    textarea.form-control {
        resize: vertical;
        min-height: 100px;
    }

    .form-help {
        font-size: 12px;
        color: #6c757d;
        margin-top: 6px;
    }

    .form-actions {
        display: flex;
        gap: 12px;
        margin-top: 30px;
        padding-top: 20px;
        border-top: 2px solid #e9ecef;
    }

    .btn {
        padding: 12px 24px;
        border: none;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
    }

    .btn-success {
        background: #27ae60;
        color: white;
    }

    .btn-success:hover {
        background: #229954;
    }

    .btn-secondary {
        background: #95a5a6;
        color: white;
    }

    .btn-secondary:hover {
        background: #7f8c8d;
    }

    .input-group {
        position: relative;
    }

    .input-group i {
        position: absolute;
        left: 16px;
        top: 50%;
        transform: translateY(-50%);
        color: #adb5bd;
        font-size: 18px;
    }

    .input-group .form-control {
        padding-left: 48px;
    }
</style>

<div class="page-header">
    <h1><i class="zmdi zmdi-plus-circle"></i> Tambah Produk</h1>
    <div class="breadcrumb">
        <a href="{{ route('admin.produk.index') }}">Produk</a>
        <span>/</span>
        <span>Tambah Produk</span>
    </div>
</div>

<div class="form-container">
    <form action="{{ route('admin.produk.store') }}" method="POST">
        @csrf
        
        <div class="form-group">
            <label>
                Kategori<span class="required">*</span>
            </label>
            <select name="kategori_id" class="form-control" required>
                <option value="">-- Pilih Kategori --</option>
                @foreach($kategoris as $kategori)
                <option value="{{ $kategori->id }}" {{ old('kategori_id') == $kategori->id ? 'selected' : '' }}>
                    {{ $kategori->nama_kategori }}
                </option>
                @endforeach
            </select>
            <div class="form-help">Pilih kategori produk yang sesuai</div>
        </div>

        <div class="form-group">
            <label>
                Nama Produk<span class="required">*</span>
            </label>
            <div class="input-group">
                <i class="zmdi zmdi-shopping-cart"></i>
                <input type="text" name="nama_produk" class="form-control" value="{{ old('nama_produk') }}" placeholder="Masukkan nama produk" required>
            </div>
        </div>

        <div class="form-group">
            <label>URL Gambar Produk</label>
            <div class="input-group">
                <i class="zmdi zmdi-image"></i>
                <input type="url" name="gambar_produk" class="form-control" value="{{ old('gambar_produk') }}" placeholder="https://example.com/image.jpg">
            </div>
            <div class="form-help">Masukkan URL gambar dari CDN atau sumber eksternal</div>
        </div>

        <div class="form-group">
            <label>
                Harga Produk<span class="required">*</span>
            </label>
            <div class="input-group">
                <i class="zmdi zmdi-money"></i>
                <input type="number" name="harga_produk" class="form-control" value="{{ old('harga_produk') }}" step="0.01" min="0" placeholder="0" required>
            </div>
            <div class="form-help">Masukkan harga dalam Rupiah</div>
        </div>

        <div class="form-group">
            <label>
                Stok Produk<span class="required">*</span>
            </label>
            <div class="input-group">
                <i class="zmdi zmdi-storage"></i>
                <input type="number" name="stok_produk" class="form-control" value="{{ old('stok_produk') }}" min="0" placeholder="0" required>
            </div>
            <div class="form-help">Jumlah stok produk yang tersedia</div>
        </div>

        <div class="form-group">
            <label>
                Deskripsi Produk<span class="required">*</span>
            </label>
            <textarea name="deskripsi_produk" class="form-control" rows="5" placeholder="Masukkan deskripsi produk..." required>{{ old('deskripsi_produk') }}</textarea>
            <div class="form-help">Deskripsikan produk dengan detail</div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-success">
                <i class="zmdi zmdi-check"></i> Simpan Produk
            </button>
            <a href="{{ route('admin.produk.index') }}" class="btn btn-secondary">
                <i class="zmdi zmdi-close"></i> Batal
            </a>
        </div>
    </form>
</div>

@endsection

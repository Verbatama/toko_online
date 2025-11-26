@extends('admin.layout')

@section('title', 'Tambah Kategori')

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
        max-width: 600px;
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
    <h1><i class="zmdi zmdi-plus-circle"></i> Tambah Kategori</h1>
    <div class="breadcrumb">
        <a href="{{ route('admin.kategori.index') }}">Kategori</a>
        <span>/</span>
        <span>Tambah Kategori</span>
    </div>
</div>

<div class="form-container">
    <form action="{{ route('admin.kategori.store') }}" method="POST">
        @csrf
        
        <div class="form-group">
            <label>
                Nama Kategori<span class="required">*</span>
            </label>
            <div class="input-group">
                <i class="zmdi zmdi-label"></i>
                <input type="text" name="nama_kategori" class="form-control" value="{{ old('nama_kategori') }}" placeholder="Masukkan nama kategori" required>
            </div>
            <div class="form-help">Contoh: Elektronik, Fashion, Makanan & Minuman</div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-success">
                <i class="zmdi zmdi-check"></i> Simpan Kategori
            </button>
            <a href="{{ route('admin.kategori.index') }}" class="btn btn-secondary">
                <i class="zmdi zmdi-close"></i> Batal
            </a>
        </div>
    </form>
</div>

@endsection
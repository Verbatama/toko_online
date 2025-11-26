@extends('admin.layout')

@section('title', 'Daftar Kategori')

@section('content')
<style>
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
    }

    .page-header h1 {
        color: #2c3e50;
        font-size: 28px;
        font-weight: 700;
        margin: 0;
    }

    .btn {
        padding: 10px 20px;
        border: none;
        border-radius: 6px;
        font-size: 14px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
    }

    .btn-primary {
        background: #3498db;
        color: white;
    }

    .btn-primary:hover {
        background: #2980b9;
    }

    .btn-warning {
        background: #f39c12;
        color: white;
    }

    .btn-warning:hover {
        background: #e67e22;
    }

    .btn-danger {
        background: #e74c3c;
        color: white;
    }

    .btn-danger:hover {
        background: #c0392b;
    }

    .btn-sm {
        padding: 6px 12px;
        font-size: 13px;
    }

    .table-container {
        background: white;
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        overflow: hidden;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    thead {
        background: #f8f9fa;
    }

    th {
        padding: 16px;
        text-align: left;
        font-weight: 600;
        color: #2c3e50;
        font-size: 14px;
        border-bottom: 2px solid #e9ecef;
    }

    td {
        padding: 16px;
        border-bottom: 1px solid #e9ecef;
        font-size: 14px;
        color: #495057;
    }

    tbody tr:hover {
        background: #f8f9fa;
    }

    .action-buttons {
        display: flex;
        gap: 8px;
    }

    .kategori-badge {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 8px 16px;
        border-radius: 20px;
        font-weight: 500;
        display: inline-block;
    }

    .empty-state {
        text-align: center;
        padding: 60px 20px;
        color: #7f8c8d;
    }

    .empty-state i {
        font-size: 64px;
        margin-bottom: 20px;
        opacity: 0.5;
    }

    .empty-state h3 {
        font-size: 20px;
        margin-bottom: 10px;
    }
</style>

<div class="page-header">
    <h1><i class="zmdi zmdi-label"></i> Daftar Kategori</h1>
    <a href="{{ route('admin.kategori.create') }}" class="btn btn-primary">
        <i class="zmdi zmdi-plus"></i> Tambah Kategori
    </a>
</div>

<div class="table-container">
    @if($kategoris->count() > 0)
    <table>
        <thead>
            <tr>
                <th style="width: 100px;">ID</th>
                <th>Nama Kategori</th>
                <th style="width: 200px;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($kategoris as $kategori)
            <tr>
                <td><strong>#{{ $kategori->id }}</strong></td>
                <td>
                    <span class="kategori-badge">
                        <i class="zmdi zmdi-label"></i> {{ $kategori->nama_kategori }}
                    </span>
                </td>
                <td>
                    <div class="action-buttons">
                        <a href="{{ route('admin.kategori.edit', $kategori->id) }}" class="btn btn-warning btn-sm">
                            <i class="zmdi zmdi-edit"></i> Edit
                        </a>
                        <form action="{{ route('admin.kategori.destroy', $kategori->id) }}" method="POST" style="margin: 0;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus kategori ini?')">
                                <i class="zmdi zmdi-delete"></i> Hapus
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <div class="empty-state">
        <i class="zmdi zmdi-label"></i>
        <h3>Belum Ada Kategori</h3>
        <p>Klik tombol "Tambah Kategori" untuk menambahkan kategori baru</p>
    </div>
    @endif
</div>

@endsection

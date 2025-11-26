@extends('admin.layout')

@section('title', 'Daftar Produk')

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
        vertical-align: middle;
    }

    tbody tr:hover {
        background: #f8f9fa;
    }

    .product-image {
        width: 60px;
        height: 60px;
        object-fit: cover;
        border-radius: 8px;
        border: 2px solid #e9ecef;
    }

    .no-image {
        width: 60px;
        height: 60px;
        background: #f8f9fa;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #adb5bd;
        font-size: 12px;
    }

    .action-buttons {
        display: flex;
        gap: 8px;
    }

    .badge-stock {
        padding: 4px 10px;
        border-radius: 12px;
        font-size: 12px;
        font-weight: 600;
    }

    .badge-stock.low {
        background: #fff3cd;
        color: #856404;
    }

    .badge-stock.normal {
        background: #d4edda;
        color: #155724;
    }

    .badge-stock.out {
        background: #f8d7da;
        color: #721c24;
    }

    .pagination {
        padding: 20px;
        display: flex;
        justify-content: center;
        gap: 5px;
    }

    .pagination a,
    .pagination span {
        padding: 8px 12px;
        border-radius: 6px;
        text-decoration: none;
        color: #495057;
        background: white;
        border: 1px solid #dee2e6;
    }

    .pagination .active span {
        background: #3498db;
        color: white;
        border-color: #3498db;
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
    <h1><i class="zmdi zmdi-shopping-cart"></i> Daftar Produk</h1>
    <a href="{{ route('admin.produk.create') }}" class="btn btn-primary">
        <i class="zmdi zmdi-plus"></i> Tambah Produk
    </a>
</div>

<div class="table-container">
    @if($produks->count() > 0)
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Gambar</th>
                <th>Nama Produk</th>
                <th>Kategori</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Deskripsi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($produks as $produk)
            <tr>
                <td><strong>#{{ $produk->id }}</strong></td>
                <td>
                    @if($produk->gambar_produk)
                        <img src="{{ $produk->gambar_produk }}" alt="{{ $produk->nama_produk }}" class="product-image" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                        <div class="no-image" style="display:none;"><i class="zmdi zmdi-image-alt"></i></div>
                    @else
                        <div class="no-image"><i class="zmdi zmdi-image-alt"></i></div>
                    @endif
                </td>
                <td><strong>{{ $produk->nama_produk }}</strong></td>
                <td>
                    @if($produk->kategori)
                        <span style="background: #e3f2fd; color: #1976d2; padding: 4px 10px; border-radius: 12px; font-size: 12px;">
                            {{ $produk->kategori->nama_kategori }}
                        </span>
                    @else
                        <span style="color: #adb5bd;">-</span>
                    @endif
                </td>
                <td><strong>Rp {{ number_format($produk->harga_produk, 0, ',', '.') }}</strong></td>
                <td>
                    @if($produk->stok_produk == 0)
                        <span class="badge-stock out">Habis</span>
                    @elseif($produk->stok_produk < 10)
                        <span class="badge-stock low">{{ $produk->stok_produk }}</span>
                    @else
                        <span class="badge-stock normal">{{ $produk->stok_produk }}</span>
                    @endif
                </td>
                <td>{{ Str::limit($produk->deskripsi_produk, 50) }}</td>
                <td>
                    <div class="action-buttons">
                        <a href="{{ route('admin.produk.edit', $produk->id) }}" class="btn btn-warning btn-sm">
                            <i class="zmdi zmdi-edit"></i> Edit
                        </a>
                        <form action="{{ route('admin.produk.destroy', $produk->id) }}" method="POST" style="margin: 0;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus produk ini?')">
                                <i class="zmdi zmdi-delete"></i> Hapus
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
    @if($produks->hasPages())
    <div class="pagination">
        {{ $produks->links() }}
    </div>
    @endif
    @else
    <div class="empty-state">
        <i class="zmdi zmdi-shopping-cart"></i>
        <h3>Belum Ada Produk</h3>
        <p>Klik tombol "Tambah Produk" untuk menambahkan produk baru</p>
    </div>
    @endif
</div>

@endsection

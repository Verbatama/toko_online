@extends('admin.layout')

@section('title', 'Daftar Pesanan')

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

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }

    .stat-card {
        background: white;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        border-left: 4px solid #3498db;
    }

    .stat-card.pending {
        border-left-color: #f39c12;
    }

    .stat-card.processing {
        border-left-color: #3498db;
    }

    .stat-card.completed {
        border-left-color: #27ae60;
    }

    .stat-card.cancelled {
        border-left-color: #e74c3c;
    }

    .stat-card h3 {
        font-size: 14px;
        color: #7f8c8d;
        margin: 0 0 10px 0;
        font-weight: 500;
    }

    .stat-card .value {
        font-size: 32px;
        font-weight: 700;
        color: #2c3e50;
    }

    .filter-section {
        background: white;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        margin-bottom: 20px;
    }

    .filter-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 15px;
        align-items: end;
    }

    .form-group {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .form-group label {
        font-size: 14px;
        font-weight: 500;
        color: #495057;
    }

    .form-control {
        padding: 10px 14px;
        border: 1px solid #ddd;
        border-radius: 6px;
        font-size: 14px;
        transition: all 0.3s;
    }

    .form-control:focus {
        outline: none;
        border-color: #3498db;
        box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.1);
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
    }

    .btn-primary {
        background: #3498db;
        color: white;
    }

    .btn-primary:hover {
        background: #2980b9;
    }

    .btn-secondary {
        background: #95a5a6;
        color: white;
    }

    .btn-secondary:hover {
        background: #7f8c8d;
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

    .badge {
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        display: inline-block;
    }

    .badge-pending {
        background: #fff3cd;
        color: #856404;
    }

    .badge-processing {
        background: #cce5ff;
        color: #004085;
    }

    .badge-completed {
        background: #d4edda;
        color: #155724;
    }

    .badge-cancelled {
        background: #f8d7da;
        color: #721c24;
    }

    .action-buttons {
        display: flex;
        gap: 8px;
    }

    .btn-sm {
        padding: 6px 12px;
        font-size: 13px;
    }

    .btn-info {
        background: #17a2b8;
        color: white;
    }

    .btn-info:hover {
        background: #138496;
    }

    .btn-success {
        background: #27ae60;
        color: white;
    }

    .btn-success:hover {
        background: #229954;
    }

    .btn-danger {
        background: #e74c3c;
        color: white;
    }

    .btn-danger:hover {
        background: #c0392b;
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

    .empty-state p {
        font-size: 14px;
    }
</style>

<div class="page-header">
    <h1><i class="zmdi zmdi-receipt"></i> Daftar Pesanan</h1>
</div>

<!-- Stats Cards -->
<div class="stats-grid">
    <div class="stat-card pending">
        <h3>Pending</h3>
        <div class="value">{{ $stats['pending'] }}</div>
    </div>
    <div class="stat-card processing">
        <h3>Dikirim</h3>
        <div class="value">{{ $stats['dikirim'] }}</div>
    </div>
    <div class="stat-card completed">
        <h3>Selesai</h3>
        <div class="value">{{ $stats['selesai'] }}</div>
    </div>
    <div class="stat-card">
        <h3>Total Pesanan</h3>
        <div class="value">{{ $stats['total'] }}</div>
    </div>
</div>

<!-- Table -->
<div class="table-container">
    @if($pesanans->count() > 0)
    <table>
        <thead>
            <tr>
                <th style="width: 80px;">ID</th>
                <th>Customer</th>
                <th>Produk</th>
                <th>Jumlah</th>
                <th>Total Harga</th>
                <th>Alamat</th>
                <th>Status</th>
                <th>Tanggal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pesanans as $pesanan)
            <tr>
                <td><strong>#{{ $pesanan->id }}</strong></td>
                <td>
                    <div><strong>{{ $pesanan->nama_user }}</strong></div>
                    @if($pesanan->user)
                    <div style="font-size: 12px; color: #7f8c8d;">{{ $pesanan->user->email }}</div>
                    @endif
                </td>
                <td>
                    <strong>{{ $pesanan->produk->nama_produk }}</strong>
                </td>
                <td>{{ $pesanan->jumlah_beli }}</td>
                <td><strong>Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</strong></td>
                <td style="max-width: 200px;">{{ $pesanan->alamat }}</td>
                <td>
                    @if($pesanan->status === 'pending')
                        <span class="badge badge-pending">Pending</span>
                    @elseif($pesanan->status === 'dikirim')
                        <span class="badge badge-processing">Dikirim</span>
                    @else
                        <span class="badge badge-completed">Selesai</span>
                    @endif
                </td>
                <td style="font-size: 12px;">{{ $pesanan->created_at->format('d M Y H:i') }}</td>
                <td>
                    @if($pesanan->status === 'pending')
                        <form action="{{ route('admin.pesanan.updateStatus', $pesanan->id) }}" method="POST" style="margin: 0;">
                            @csrf
                            <input type="hidden" name="status" value="dikirim">
                            <button type="submit" class="btn btn-info btn-sm">
                                <i class="zmdi zmdi-truck"></i> Kirim
                            </button>
                        </form>
                    @elseif($pesanan->status === 'dikirim')
                        <form action="{{ route('admin.pesanan.updateStatus', $pesanan->id) }}" method="POST" style="margin: 0;">
                            @csrf
                            <input type="hidden" name="status" value="selesai">
                            <button type="submit" class="btn btn-success btn-sm">
                                <i class="zmdi zmdi-check"></i> Selesai
                            </button>
                        </form>
                    @else
                        <span style="color: #27ae60; font-weight: 600;">✓ Selesai</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <div class="empty-state">
        <i class="zmdi zmdi-receipt"></i>
        <h3>Belum Ada Pesanan</h3>
        <p>Pesanan dari customer akan muncul di sini</p>
    </div>
    @endif
</div>

@endsection

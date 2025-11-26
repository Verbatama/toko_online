<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - Toko Kita</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f5f5;
        }

        .navbar {
            background-color: #2c3e50;
            padding: 1rem 2rem;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .navbar-container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar-brand {
            color: white;
            font-size: 1.5rem;
            font-weight: bold;
            text-decoration: none;
        }

        .container {
            max-width: 900px;
            margin: 2rem auto;
            padding: 0 2rem;
        }

        .page-title {
            color: #2c3e50;
            margin-bottom: 2rem;
            font-size: 2rem;
        }

        .checkout-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 2rem;
        }

        .card {
            background: white;
            border-radius: 10px;
            padding: 2rem;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        .card h2 {
            color: #2c3e50;
            margin-bottom: 1.5rem;
            font-size: 1.5rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            color: #2c3e50;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .form-control {
            width: 100%;
            padding: 0.75rem;
            border: 2px solid #e9ecef;
            border-radius: 8px;
            font-size: 1rem;
            transition: border-color 0.3s;
        }

        .form-control:focus {
            outline: none;
            border-color: #3498db;
        }

        textarea.form-control {
            resize: vertical;
            min-height: 100px;
        }

        .order-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 0;
            border-bottom: 1px solid #e9ecef;
        }

        .order-item:last-child {
            border-bottom: none;
        }

        .item-info {
            flex: 1;
        }

        .item-name {
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 0.25rem;
        }

        .item-price {
            color: #7f8c8d;
            font-size: 0.9rem;
        }

        .item-total {
            font-weight: 600;
            color: #27ae60;
            font-size: 1.1rem;
        }

        .total-section {
            margin-top: 1.5rem;
            padding-top: 1.5rem;
            border-top: 2px solid #e9ecef;
        }

        .total-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 0.5rem;
            font-size: 1.1rem;
        }

        .total-row.grand-total {
            font-size: 1.5rem;
            font-weight: 700;
            color: #2c3e50;
            margin-top: 1rem;
        }

        .btn {
            padding: 1rem 2rem;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-block;
        }

        .btn-primary {
            background: #27ae60;
            color: white;
            width: 100%;
        }

        .btn-primary:hover {
            background: #229954;
            transform: translateY(-2px);
        }

        .btn-secondary {
            background: #95a5a6;
            color: white;
        }

        .btn-secondary:hover {
            background: #7f8c8d;
        }

        .alert {
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
        }

        .alert-error {
            background: #f8d7da;
            color: #721c24;
        }

        @media (max-width: 768px) {
            .checkout-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="navbar-container">
            <a href="{{ url('/') }}" class="navbar-brand">Toko Kita</a>
        </div>
    </nav>

    <div class="container">
        <h1 class="page-title">Checkout</h1>

        @if(session('error'))
            <div class="alert alert-error">{{ session('error') }}</div>
        @endif

        <div class="checkout-grid">
            <!-- Form Pengiriman -->
            <div class="card">
                <h2>Informasi Pengiriman</h2>
                <form action="{{ route('checkout.store') }}" method="POST">
                    @csrf
                    
                    <div class="form-group">
                        <label>Nama Penerima</label>
                        <input type="text" name="nama" class="form-control" value="{{ old('nama', session('logged_user_name')) }}" required>
                        @error('nama')
                            <div style="color: #e74c3c; font-size: 0.9rem; margin-top: 0.25rem;">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Alamat Pengiriman *</label>
                        <textarea name="alamat" class="form-control" required placeholder="Masukkan alamat lengkap pengiriman">{{ old('alamat') }}</textarea>
                        @error('alamat')
                            <div style="color: #e74c3c; font-size: 0.9rem; margin-top: 0.25rem;">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">
                        Konfirmasi Pesanan
                    </button>

                    <a href="{{ route('keranjang.index') }}" class="btn btn-secondary" style="margin-top: 1rem; text-align: center;">
                        Kembali ke Keranjang
                    </a>
                </form>
            </div>

            <!-- Ringkasan Pesanan -->
            <div class="card">
                <h2>Ringkasan Pesanan</h2>
                
                @foreach($keranjangs as $item)
                <div class="order-item">
                    <div class="item-info">
                        <div class="item-name">{{ $item->produk->nama_produk }}</div>
                        <div class="item-price">
                            Rp {{ number_format($item->produk->harga_produk, 0, ',', '.') }} x {{ $item->jumlah }}
                        </div>
                    </div>
                    <div class="item-total">
                        Rp {{ number_format($item->produk->harga_produk * $item->jumlah, 0, ',', '.') }}
                    </div>
                </div>
                @endforeach

                <div class="total-section">
                    <div class="total-row grand-total">
                        <span>Total:</span>
                        <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

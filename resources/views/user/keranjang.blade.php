<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja - Toko Online</title>
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

        /* Navbar Styles */
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

        .navbar-menu {
            list-style: none;
            display: flex;
            gap: 2rem;
        }

        .navbar-menu li a {
            color: white;
            text-decoration: none;
            transition: color 0.3s;
        }

        .navbar-menu li a:hover {
            color: #3498db;
        }

        .navbar-menu button {
            background: none;
            border: none;
            color: white;
            cursor: pointer;
            font-size: 1rem;
        }

        /* Container */
        .container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 2rem;
        }

        .page-title {
            color: #2c3e50;
            margin-bottom: 2rem;
            font-size: 2rem;
        }

        /* Alert Messages */
        .alert {
            padding: 1rem;
            border-radius: 5px;
            margin-bottom: 1rem;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert-error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        /* Cart Table */
        .cart-table {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            margin-bottom: 2rem;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background-color: #2c3e50;
            color: white;
        }

        th, td {
            padding: 1rem;
            text-align: left;
        }

        tbody tr {
            border-bottom: 1px solid #ecf0f1;
        }

        tbody tr:hover {
            background-color: #f8f9fa;
        }

        .product-info {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .product-image {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 5px;
        }

        .product-details h4 {
            color: #2c3e50;
            margin-bottom: 0.25rem;
        }

        .product-details p {
            color: #7f8c8d;
            font-size: 0.9rem;
        }

        .quantity-control {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .quantity-control input {
            width: 60px;
            padding: 0.5rem;
            border: 1px solid #ddd;
            border-radius: 5px;
            text-align: center;
        }

        .btn {
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 0.9rem;
            transition: background-color 0.3s;
        }

        .btn-update {
            background-color: #3498db;
            color: white;
        }

        .btn-update:hover {
            background-color: #2980b9;
        }

        .btn-delete {
            background-color: #e74c3c;
            color: white;
        }

        .btn-delete:hover {
            background-color: #c0392b;
        }

        .btn-primary {
            background-color: #27ae60;
            color: white;
            padding: 1rem 2rem;
            font-size: 1rem;
        }

        .btn-primary:hover {
            background-color: #229954;
        }

        .btn-secondary {
            background-color: #95a5a6;
            color: white;
        }

        .btn-secondary:hover {
            background-color: #7f8c8d;
        }

        /* Cart Summary */
        .cart-summary {
            background: white;
            border-radius: 10px;
            padding: 2rem;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            max-width: 400px;
            margin-left: auto;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 1rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid #ecf0f1;
        }

        .summary-total {
            font-size: 1.5rem;
            font-weight: bold;
            color: #27ae60;
        }

        .cart-actions {
            display: flex;
            gap: 1rem;
            margin-top: 1.5rem;
        }

        .empty-cart {
            text-align: center;
            padding: 3rem;
            color: #7f8c8d;
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        .empty-cart h3 {
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }

        .empty-cart a {
            display: inline-block;
            margin-top: 1rem;
            padding: 1rem 2rem;
            background-color: #3498db;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        .empty-cart a:hover {
            background-color: #2980b9;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .navbar-container {
                flex-direction: column;
                gap: 1rem;
            }

            .navbar-menu {
                gap: 1rem;
            }

            table {
                font-size: 0.9rem;
            }

            th, td {
                padding: 0.5rem;
            }

            .product-info {
                flex-direction: column;
            }

            .cart-summary {
                max-width: 100%;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="navbar-container">
            <a href="{{ url('/') }}" class="navbar-brand">Toko Online</a>
            <ul class="navbar-menu">
                <li><a href="{{ url('/') }}">Home</a></li>
                <li><a href="{{ route('keranjang.index') }}">Keranjang</a></li>
                @if(session('logged_user_id'))
                    <li><a href="#">Halo, {{ session('logged_user_name') }}</a></li>
                    <li>
                        <form action="{{ url('/logout') }}" method="POST" style="display: inline;">
                            @csrf
                            <button type="submit">Logout</button>
                        </form>
                    </li>
                @else
                    <li><a href="{{ url('/login') }}">Login</a></li>
                    <li><a href="{{ url('/register') }}">Register</a></li>
                @endif
            </ul>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container">
        <h1 class="page-title">Keranjang Belanja</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-error">
                {{ session('error') }}
            </div>
        @endif

        @if($keranjangs->count() > 0)
            <script>
                function increaseQtyCart(id) {
                    const input = document.getElementById('qty-' + id);
                    const maxStock = parseInt(input.getAttribute('data-max'));
                    const currentVal = parseInt(input.value) || 1;
                    if (currentVal < maxStock) {
                        input.value = currentVal + 1;
                    }
                }
                
                function decreaseQtyCart(id) {
                    const input = document.getElementById('qty-' + id);
                    const currentVal = parseInt(input.value) || 1;
                    if (currentVal > 1) {
                        input.value = currentVal - 1;
                    }
                }
                
                // Validasi input manual untuk semua input di keranjang
                document.addEventListener('DOMContentLoaded', function() {
                    const inputs = document.querySelectorAll('input[type="number"][id^="qty-"]');
                    inputs.forEach(input => {
                        input.addEventListener('input', function() {
                            const maxStock = parseInt(this.getAttribute('data-max'));
                            let value = parseInt(this.value) || 1;
                            if (value < 1) value = 1;
                            if (value > maxStock) value = maxStock;
                            this.value = value;
                        });
                    });
                });
            </script>
            
            <div class="cart-table">
                <table>
                    <thead>
                        <tr>
                            <th>Produk</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Subtotal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($keranjangs as $keranjang)
                        <tr>
                            <td>
                                <div class="product-info">
                                    @if($keranjang->produk->gambar_produk)
                                        <img src="{{ $keranjang->produk->gambar_produk }}" alt="{{ $keranjang->produk->nama_produk }}" class="product-image">
                                    @else
                                        <img src="https://via.placeholder.com/80" alt="{{ $keranjang->produk->nama_produk }}" class="product-image">
                                    @endif
                                    <div class="product-details">
                                        <h4>{{ $keranjang->produk->nama_produk }}</h4>
                                        <p>{{ $keranjang->produk->kategori->nama_kategori ?? '' }}</p>
                                    </div>
                                </div>
                            </td>
                            <td>Rp {{ number_format($keranjang->produk->harga_produk, 0, ',', '.') }}</td>
                            <td>
                                <form action="{{ route('keranjang.update', $keranjang->id) }}" method="POST" class="quantity-control" id="form-{{ $keranjang->id }}">
                                    @csrf
                                    @method('PUT')
                                    <button type="button" onclick="decreaseQtyCart({{ $keranjang->id }})" class="btn btn-update" style="padding: 0.5rem 0.75rem;">-</button>
                                    <input type="number" name="jumlah" id="qty-{{ $keranjang->id }}" value="{{ $keranjang->jumlah }}" min="1" max="{{ $keranjang->produk->stok_produk }}" data-max="{{ $keranjang->produk->stok_produk }}">
                                    <button type="button" onclick="increaseQtyCart({{ $keranjang->id }})" class="btn btn-update" style="padding: 0.5rem 0.75rem;">+</button>
                                    <button type="submit" class="btn btn-update">Update</button>
                                </form>
                            </td>
                            <td><strong>Rp {{ number_format($keranjang->jumlah * $keranjang->produk->harga_produk, 0, ',', '.') }}</strong></td>
                            <td>
                                <form action="{{ route('keranjang.destroy', $keranjang->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-delete" onclick="return confirm('Hapus produk dari keranjang?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="cart-summary">
                <div class="summary-row">
                    <span>Total Items:</span>
                    <strong>{{ $keranjangs->sum('jumlah') }} items</strong>
                </div>
                <div class="summary-row">
                    <span>Total Harga:</span>
                    <span class="summary-total">Rp {{ number_format($total, 0, ',', '.') }}</span>
                </div>
                <div class="cart-actions">
                    <a href="{{ route('checkout.index') }}" class="btn btn-primary" style="flex: 1; text-align: center; text-decoration: none;">Checkout</a>
                    <form action="{{ route('keranjang.clear') }}" method="POST" style="flex: 1;">
                        @csrf
                        <button type="submit" class="btn btn-secondary" style="width: 100%;" onclick="return confirm('Kosongkan keranjang?')">Kosongkan</button>
                    </form>
                </div>
            </div>
        @else
            <div class="empty-cart">
                <h3>Keranjang Anda Kosong</h3>
                <p>Belum ada produk di keranjang belanja Anda.</p>
                <a href="{{ url('/') }}">Belanja Sekarang</a>
            </div>
        @endif
    </div>
</body>
</html>

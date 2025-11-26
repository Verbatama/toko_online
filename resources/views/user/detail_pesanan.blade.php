<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan Saya - Toko Online</title>
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

        /* Stats Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: white;
            padding: 1.5rem;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            border-left: 4px solid #3498db;
        }

        .stat-card.pending {
            border-left-color: #f39c12;
        }

        .stat-card.dikirim {
            border-left-color: #3498db;
        }

        .stat-card.selesai {
            border-left-color: #27ae60;
        }

        .stat-card h3 {
            font-size: 0.9rem;
            color: #7f8c8d;
            margin-bottom: 0.5rem;
        }

        .stat-card .value {
            font-size: 2rem;
            font-weight: 700;
            color: #2c3e50;
        }

        /* Order List */
        .order-list {
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            overflow: hidden;
        }

        .order-item {
            padding: 1.5rem;
            border-bottom: 1px solid #e9ecef;
            display: grid;
            grid-template-columns: 80px 1fr auto;
            gap: 1.5rem;
            align-items: center;
            transition: background 0.3s;
        }

        .order-item:hover {
            background: #f8f9fa;
        }

        .order-item:last-child {
            border-bottom: none;
        }

        .order-image {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 8px;
            border: 2px solid #e9ecef;
        }

        .order-info h3 {
            color: #2c3e50;
            font-size: 1.1rem;
            margin-bottom: 0.5rem;
        }

        .order-details {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
            font-size: 0.9rem;
            color: #7f8c8d;
        }

        .order-details span {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .order-meta {
            text-align: right;
        }

        .order-price {
            font-size: 1.3rem;
            font-weight: 700;
            color: #27ae60;
            margin-bottom: 0.5rem;
        }

        .order-quantity {
            font-size: 0.9rem;
            color: #7f8c8d;
            margin-bottom: 1rem;
        }

        .order-date {
            font-size: 0.85rem;
            color: #95a5a6;
            margin-top: 0.5rem;
        }

        .badge {
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            display: inline-block;
        }

        .badge-pending {
            background: #fff3cd;
            color: #856404;
        }

        .badge-dikirim {
            background: #cce5ff;
            color: #004085;
        }

        .badge-selesai {
            background: #d4edda;
            color: #155724;
        }

        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            color: #7f8c8d;
        }

        .empty-state h3 {
            font-size: 1.5rem;
            margin-bottom: 1rem;
            color: #2c3e50;
        }

        .empty-state p {
            margin-bottom: 2rem;
        }

        .empty-state a {
            display: inline-block;
            padding: 0.75rem 2rem;
            background: #3498db;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            transition: background 0.3s;
        }

        .empty-state a:hover {
            background: #2980b9;
        }

        .alert {
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
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

            .order-item {
                grid-template-columns: 1fr;
                text-align: center;
            }

            .order-meta {
                text-align: center;
            }

            .stats-grid {
                grid-template-columns: 1fr;
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
                @if(session('logged_user_id') && session('logged_user_role') === 'user')
                    <li><a href="{{ route('keranjang.index') }}">Keranjang</a></li>
                    <li><a href="{{ route('user.pesanan') }}">Pesanan Saya</a></li>
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
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <h1 class="page-title">Pesanan Saya</h1>

        <!-- Stats Cards -->
        <div class="stats-grid">
            <div class="stat-card pending">
                <h3>Pending</h3>
                <div class="value">{{ $stats['pending'] }}</div>
            </div>
            <div class="stat-card dikirim">
                <h3>Sedang Dikirim</h3>
                <div class="value">{{ $stats['dikirim'] }}</div>
            </div>
            <div class="stat-card selesai">
                <h3>Selesai</h3>
                <div class="value">{{ $stats['selesai'] }}</div>
            </div>
        </div>

        <!-- Order List -->
        @if($pesanans->count() > 0)
        <div class="order-list">
            @foreach($pesanans as $pesanan)
            <div class="order-item">
                <img src="{{ $pesanan->produk->gambar_produk ?? 'https://via.placeholder.com/80' }}" 
                     alt="{{ $pesanan->produk->nama_produk }}" 
                     class="order-image"
                     onerror="this.src='https://via.placeholder.com/80/3498db/ffffff?text=Product'">
                
                <div class="order-info">
                    <h3>{{ $pesanan->produk->nama_produk }}</h3>
                    <div class="order-details">
                        <span>📦 Jumlah: {{ $pesanan->jumlah_beli }} pcs</span>
                        <span>👤 Penerima: {{ $pesanan->nama_user }}</span>
                        <span>📍 {{ Str::limit($pesanan->alamat, 80) }}</span>
                        <span class="order-date">📅 {{ $pesanan->created_at->format('d M Y, H:i') }}</span>
                    </div>
                </div>
                
                <div class="order-meta">
                    <div class="order-price">Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</div>
                    @if($pesanan->status === 'pending')
                        <span class="badge badge-pending">⏳ Pending</span>
                    @elseif($pesanan->status === 'dikirim')
                        <span class="badge badge-dikirim">🚚 Sedang Dikirim</span>
                    @else
                        <span class="badge badge-selesai">✓ Selesai</span>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="order-list">
            <div class="empty-state">
                <h3>Belum Ada Pesanan</h3>
                <p>Anda belum memiliki pesanan. Mulai belanja sekarang!</p>
                <a href="{{ url('/') }}">Belanja Sekarang</a>
            </div>
        </div>
        @endif
    </div>
</body>
</html>

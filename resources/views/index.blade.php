<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Toko Online</title>
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

        /* Container */
        .container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 2rem;
        }

        .page-title {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 2rem;
            font-size: 2rem;
        }

        /* Card Grid */
        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 2rem;
            margin-top: 2rem;
        }

        /* Card Styles */
        .product-card {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            transition: transform 0.3s, box-shadow 0.3s;
            cursor: pointer;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0,0,0,0.15);
        }

        .product-image {
            width: 100%;
            height: 250px;
            object-fit: cover;
            background-color: #ecf0f1;
        }

        .product-info {
            padding: 1.5rem;
        }

        .product-name {
            font-size: 1.2rem;
            color: #2c3e50;
            margin-bottom: 0.5rem;
            font-weight: 600;
        }

        .product-price {
            color: #27ae60;
            font-size: 1.1rem;
            font-weight: bold;
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

            .product-grid {
                grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
                gap: 1rem;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="navbar-container">
            <a href="#" class="navbar-brand">Toko Online</a>
            <ul class="navbar-menu">
                <li><a href="#">Home</a></li>
                <li><a href="#">Produk</a></li>
                <li><a href="#">Akun</a></li>
                <li><a href="#"></a></li>
            </ul>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container">
      

        <!-- Product Grid -->
        <div class="product-grid">
            @forelse($produks as $produk)
            <!-- Product Card -->
            <div class="product-card">
                @if($produk->gambar_produk)
                    <img src="{{ $produk->gambar_produk }}" alt="{{ $produk->nama_produk }}" class="product-image" onerror="this.src='https://via.placeholder.com/250x250/3498db/ffffff?text={{ urlencode($produk->nama_produk) }}'">
                @else
                    <img src="" alt="{{ $produk->nama_produk }}" class="product-image">
                @endif
                <div class="product-info">
                    <h3 class="product-name">{{ $produk->nama_produk }}</h3>
                    <p class="product-price">Rp {{ number_format($produk->harga_produk, 0, ',', '.') }}</p>
                    @if($produk->kategori)
                    <p style="color: #7f8c8d; font-size: 0.9rem; margin-top: 0.5rem;">{{ $produk->kategori->nama_kategori }}</p>
                    @endif
                    @if($produk->stok_produk > 0)
                    <p style="color: #27ae60; font-size: 0.85rem; margin-top: 0.5rem;">Stok: {{ $produk->stok_produk }}</p>
                    @else
                    <p style="color: #e74c3c; font-size: 0.85rem; margin-top: 0.5rem;">Stok Habis</p>
                    @endif
                </div>
            </div>
            @empty
            <div style="grid-column: 1 / -1; text-align: center; padding: 3rem; color: #7f8c8d;">
                <p style="font-size: 1.2rem;">Belum ada produk tersedia.</p>
            </div>
            @endforelse
        </div>
    </div>
</body>
</html>
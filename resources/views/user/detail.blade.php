<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->nama_produk }} - Toko Online</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            padding: 20px;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
        }

        .back-link {
            display: inline-block;
            color: #3498db;
            text-decoration: none;
            margin-bottom: 20px;
        }

        .back-link:hover {
            text-decoration: underline;
        }

        .product-image {
            width: 50%;
            max-height: 400px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .product-title {
            font-size: 24px;
            margin-bottom: 10px;
            color: #333;
        }

        .product-price {
            font-size: 28px;
            color: #27ae60;
            font-weight: bold;
            margin-bottom: 15px;
        }

        .product-info {
            margin-bottom: 15px;
            color: #666;
        }

        .product-info span {
            display: inline-block;
            margin-right: 15px;
        }

        .product-description {
            line-height: 1.6;
            color: #555;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #ddd;
        }

        .btn {
            display: inline-block;
            padding: 12px 30px;
            background-color: #3498db;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            border: none;
            cursor: pointer;
            margin-top: 15px;
            margin-right: 10px;
        }

        .btn:hover {
            background-color: #2980b9;
        }

        .btn-buy {
            background-color: #27ae60;
        }

        .btn-buy:hover {
            background-color: #229954;
        }

        .btn:disabled {
            background-color: #95a5a6;
            cursor: not-allowed;
        }

        @media (max-width: 768px) {
            body {
                padding: 10px;
            }

            .container {
                padding: 15px;
            }

            .product-title {
                font-size: 20px;
            }

            .product-price {
                font-size: 24px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="/" class="back-link">← Kembali</a>

        @if($product->gambar_produk)
            <img src="{{ $product->gambar_produk }}" alt="{{ $product->nama_produk }}" class="product-image">
        @endif

        <h1 class="product-title">{{ $product->nama_produk }}</h1>

        <div class="product-price">Rp {{ number_format($product->harga_produk, 0, ',', '.') }}</div>

        <div class="product-info">
            @if($product->kategori)
                <span><strong>Kategori:</strong> {{ $product->kategori->nama_kategori }}</span>
            @endif
            <span><strong>Stok:</strong> 
                @if($product->stok_produk > 0)
                    <span style="color: #27ae60;">{{ $product->stok_produk }} unit</span>
                @else
                    <span style="color: #e74c3c;">Habis</span>
                @endif
            </span>
        </div>

        @if($product->stok_produk > 0)
            <button class="btn">Tambah ke Keranjang</button>
            <button class="btn btn-buy">Beli Sekarang</button>
        @else
            <button class="btn" disabled>Stok Habis</button>
        @endif

        @if($product->deskripsi_produk)
            <div class="product-description">
                <h3>Deskripsi</h3>
                <p>{{ $product->deskripsi_produk }}</p>
            </div>
        @endif
    </div>
</body>
</html>
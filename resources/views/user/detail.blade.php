<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $produk->nama_produk }} - Toko Kita</title>
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

        @if($produk->gambar_produk)
            <img src="{{ $produk->gambar_produk }}" alt="{{ $produk->nama_produk }}" class="product-image">
        @endif

        <h1 class="product-title">{{ $produk->nama_produk }}</h1>
        <div class="product-price">Rp {{ number_format($produk->harga_produk, 0, ',', '.') }}</div>

        <div class="product-info">
            @if($produk->kategori)
                <span><strong>Kategori:</strong> {{ $produk->kategori->nama_kategori }}</span>
            @endif
            <span><strong>Stok:</strong> 
                @if($produk->stok_produk > 0)
                    <span style="color: #27ae60;">{{ $produk->stok_produk }} unit</span>
                @else
                    <span style="color: #e74c3c;">Habis</span>
                @endif
            </span>
        </div>

        @if($produk->stok_produk > 0)
            <form action="{{ route('keranjang.store') }}" method="POST" style="display: inline;">
                @csrf
                <input type="hidden" name="produk_id" value="{{ $produk->id }}">
                <label for="jumlah" style="margin-right: 10px;"><strong>Jumlah:</strong></label>
                <div style="display: inline-flex; align-items: center; gap: 5px; margin-right: 10px;">
                    <button type="button" onclick="decreaseQty()" class="btn" style="padding: 8px 15px; margin: 0;">-</button>
                    <input type="number" name="jumlah" id="jumlah" value="1" min="1" max="{{ $produk->stok_produk }}" 
                           style="width: 80px; padding: 8px; border: 1px solid #ddd; border-radius: 5px; text-align: center;">
                    <button type="button" onclick="increaseQty()" class="btn" style="padding: 8px 15px; margin: 0;">+</button>
                </div>
                <button type="submit" class="btn">Tambah ke Keranjang</button>
            </form>
            <script>
                const maxStock = {{ $produk->stok_produk }};
                
                function increaseQty() {
                    const input = document.getElementById('jumlah');
                    const currentVal = parseInt(input.value) || 1;
                    if (currentVal < maxStock) {
                        input.value = currentVal + 1;
                    }
                }
                
                function decreaseQty() {
                    const input = document.getElementById('jumlah');
                    const currentVal = parseInt(input.value) || 1;
                    if (currentVal > 1) {
                        input.value = currentVal - 1;
                    }
                }
                
                // Validasi input manual
                document.getElementById('jumlah').addEventListener('input', function() {
                    let value = parseInt(this.value) || 1;
                    if (value < 1) value = 1;
                    if (value > maxStock) value = maxStock;
                    this.value = value;
                });
            </script>
        @else
            <button class="btn" disabled>Stok Habis</button>
        @endif

        @if($produk->deskripsi_produk)
            <div class="product-description">
                <h3>Deskripsi</h3>
                <p>{{ $produk->deskripsi_produk }}</p>
            </div>
        @endif
    </div>
</body>
</html>
@extends('admin.layout')

@section('title', 'Daftar Produk')

@section('content')
<h1>Daftar Produk</h1>
<a href="{{ route('admin.produk.create') }}" class="btn btn-primary mb-3">Tambah Produk</a>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Gambar</th>
            <th>Nama Produk</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Deskripsi</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($produks as $produk)
        <tr>
            <td>{{ $produk->id }}</td>
            <td>
                @if($produk->gambar_produk)
                    <img src="{{ $produk->gambar_produk }}" alt="{{ $produk->nama_produk }}" style="width: 60px; height: 60px; object-fit: cover; border-radius: 5px;">
                @else
                    <span class="text-muted">No Image</span>
                @endif
            </td>
            <td>{{ $produk->nama_produk }}</td>
            <td>Rp {{ number_format($produk->harga_produk, 0, ',', '.') }}</td>
            <td>{{ $produk->stok_produk }}</td>
            <td>{{ Str::limit($produk->deskripsi_produk, 50) }}</td>
            <td>
                <a href="{{ route('admin.produk.edit', $produk->id) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('admin.produk.destroy', $produk->id) }}" method="POST" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $produks->links() }}
@endsection

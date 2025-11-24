@extends('admin.layout')

@section('title', 'Daftar Kategori')

@section('content')
<h1>Daftar Kategori</h1>
<a href="{{ route('kategori.create') }}" class="btn btn-primary mb-3">Tambah Kategori</a>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama Kategori</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($kategoris as $kategori)
        <tr>
            <td>{{ $kategori->id }}</td>
            <td>{{ $kategori->nama_kategori }}</td>
            <td>
                <a href="{{ route('kategori.edit', $kategori->id) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('kategori.destroy', $kategori->id) }}" method="POST" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection

@extends('admin.layout')

@section('title', 'Tambah Kategori')

@section('content')
<h1>Tambah Kategori</h1>

<form action="{{ route('kategori.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label>Nama Kategori</label>
        <input type="text" name="nama_kategori" class="form-control" required>
    </div>
    <button class="btn btn-success">Simpan</button>
</form>
@endsection
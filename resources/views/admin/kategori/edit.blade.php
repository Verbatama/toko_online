@extends('admin.layout')

@section('title', 'Edit Kategori')

@section('content')
<h1>Edit Kategori</h1>

<form action="{{ route('admin.kategori.update', $kategori->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label>Nama Kategori</label>
        <input type="text" name="nama_kategori" class="form-control" value="{{ $kategori->nama_kategori }}" required>
    </div>
    <button class="btn btn-success">Update</button>
    <a href="{{ route('admin.kategori.index') }}" class="btn btn-secondary">Kembali</a>
</form>
@endsection

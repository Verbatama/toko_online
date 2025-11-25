<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Admin Panel')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ url('/admin') }}">Admin Panel</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav me-auto">
                <!-- <li class="nav-item"><a class="nav-link" href="{{ url('/admin') }}">Dashboard</a></li> -->
                <li class="nav-item"><a class="nav-link" href="{{ url('/admin/produk') }}">Produk</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/admin/kategori') }}">Kategori</a></li>
            </ul>
            <ul class="navbar-nav ms-auto">
                @if(session('user_name'))
                    <li class="nav-item">
                        <span class="nav-link text-white">Admin: {{ session('user_name') }}</span>
                    </li>
                @endif
                <li class="nav-item">
                    <form action="{{ url('/admin/logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-outline-light btn-sm">Logout</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="container">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @yield('content')
</div>
</body>
</html>

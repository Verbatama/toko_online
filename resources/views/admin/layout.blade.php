<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
       
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            overflow-x: hidden;
            font-family: 'Inter', sans-serif;
            font-size: 16px;
            background-color: #f8f9fa;
            color: #212529;
        }

        #viewport {
            padding-left: 260px;
            transition: all 0.3s ease;
            min-height: 100vh;
        }

        #content {
            width: 100%;
            position: relative;
        }

        /* Sidebar Styles */
        #sidebar {
            z-index: 1000;
            position: fixed;
            left: 0;
            width: 260px;
            height: 100%;
            overflow-y: auto;
            background: linear-gradient(180deg, #2c3e50 0%, #34495e 100%);
            box-shadow: 2px 0 10px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }

        #sidebar::-webkit-scrollbar {
            width: 6px;
        }

        #sidebar::-webkit-scrollbar-track {
            background: rgba(255,255,255,0.05);
        }

        #sidebar::-webkit-scrollbar-thumb {
            background: rgba(255,255,255,0.2);
            border-radius: 3px;
        }

        #sidebar header {
            background: rgba(0,0,0,0.2);
            padding: 20px;
            text-align: center;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
            position: relative;
        }

        #sidebar header a {
            color: #fff;
            text-decoration: none;
            font-size: 22px;
            font-weight: 600;
            letter-spacing: 0.5px;
            transition: color 0.3s;
        }

        #sidebar header a:hover {
            color: #3498db;
        }

        #sidebar .nav {
            list-style: none;
            padding: 10px 0;
        }

        #sidebar .nav li {
            margin: 5px 0;
        }

        #sidebar .nav a {
            display: flex;
            align-items: center;
            padding: 14px 24px;
            color: rgba(255,255,255,0.8);
            font-size: 15px;
            text-decoration: none;
            border-left: 3px solid transparent;
            transition: all 0.3s;
        }

        #sidebar .nav a:hover,
        #sidebar .nav a.active {
            background: rgba(255,255,255,0.1);
            color: #fff;
            border-left-color: #3498db;
            padding-left: 28px;
        }

        #sidebar .nav a i {
            margin-right: 12px;
            font-size: 18px;
            width: 24px;
            text-align: center;
        }

        /* Navbar Styles */
        .navbar {
            background: #fff;
            box-shadow: 0 2px 4px rgba(0,0,0,0.08);
            padding: 0;
            margin-bottom: 30px;
        }

        .navbar .container-fluid {
            padding: 12px 30px;
            display: flex;
            justify-content: flex-end;
            align-items: center;
            gap: 20px;
        }

        .navbar .nav {
            display: flex;
            list-style: none;
            align-items: center;
            gap: 20px;
            margin: 0;
            margin-left: auto;
        }

        .navbar .nav li {
            display: flex;
            align-items: center;
        }

        .navbar .nav li a,
        .navbar .nav li span {
            color: #495057;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 8px 12px;
            border-radius: 6px;
            transition: all 0.3s;
        }

        .navbar .nav li a:hover {
            background: #f8f9fa;
            color: #2c3e50;
        }

        .navbar .nav li a i {
            font-size: 20px;
        }

        .navbar .btn-logout {
            background: #e74c3c;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s;
        }

        .navbar .btn-logout:hover {
            background: #c0392b;
        }

        /* Content Styles */
        .container-fluid {
            padding: 0 30px;
            max-width: 1400px;
        }

        /* Alert Styles */
        .alert {
            padding: 15px 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
            border-left: 4px solid #28a745;
        }

        .alert-danger {
            background: #f8d7da;
            color: #721c24;
            border-left: 4px solid #dc3545;
        }

        /* Toggle Button in Sidebar */
        .toggle-btn {
            width: 32px;
            height: 32px;
            background: rgba(255,255,255,0.15);
            border: none;
            border-radius: 6px;
            color: white;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s;
        }

        .toggle-btn:hover {
            background: rgba(255,255,255,0.25);
        }

        .toggle-btn i {
            font-size: 18px;
            transition: transform 0.3s;
        }

        /* Open Button (when sidebar closed) */
        .open-btn {
            width: 40px;
            height: 40px;
            background: #3498db;
            border: none;
            border-radius: 8px;
            color: white;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 8px rgba(0,0,0,0.15);
            transition: all 0.3s;
        }

        .open-btn:hover {
            background: #2980b9;
            transform: scale(1.05);
        }

        .open-btn i {
            font-size: 20px;
        }

        /* Closed Sidebar State */
        #viewport.sidebar-closed {
            padding-left: 0;
        }

        #viewport.sidebar-closed #sidebar {
            left: -260px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            #viewport {
                padding-left: 0;
            }
            
            #sidebar {
                left: -260px;
            }
            
            #viewport.sidebar-open #sidebar {
                left: 0;
            }
        }
    </style>
</head>
<body>
    <div id="viewport">
        <!-- Sidebar -->
        <div id="sidebar">
            <header>
                <a href="{{ url('/admin') }}">Admin Panel</a>
                <button id="toggle-sidebar" class="toggle-btn">
                    <i class="zmdi zmdi-chevron-left"></i>
                </button>
            </header>
            <ul class="nav">
                <li>
                    <a href="{{ url('/admin/produk') }}" class="{{ request()->is('admin/produk*') ? 'active' : '' }}">
                        <i class="zmdi zmdi-shopping-cart"></i>
                        <span>Produk</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/admin/kategori') }}" class="{{ request()->is('admin/kategori*') ? 'active' : '' }}">
                        <i class="zmdi zmdi-label"></i>
                        <span>Kategori</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/admin/pesanan') }}" class="{{ request()->is('admin/pesanan*') ? 'active' : '' }}">
                        <i class="zmdi zmdi-receipt"></i>
                        <span>Pesanan</span>
                    </a>
                </li>
            </ul>
        </div>

        <!-- Content -->
        <div id="content">
            <nav class="navbar">
                <div class="container-fluid">
                    <button id="open-sidebar" class="open-btn" style="display: none;">
                        <i class="zmdi zmdi-menu"></i>
                    </button>
                    <ul class="nav">
                        @if(session('admin_user_name'))
                            <li>
                                <span>
                                    <i class="zmdi zmdi-account-circle"></i>
                                    {{ session('admin_user_name') }}
                                </span>
                            </li>
                        @endif
                        <li>
                            <form action="{{ url('/admin/logout') }}" method="POST" style="margin: 0;">
                                @csrf
                                <button type="submit" class="btn-logout">
                                    <i class="zmdi zmdi-power"></i> Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </nav>
            
            <div class="container-fluid">
                @if(session('success'))
                    <div class="alert alert-success">
                        <i class="zmdi zmdi-check-circle"></i> {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger">
                        <i class="zmdi zmdi-alert-circle"></i> {{ session('error') }}
                    </div>
                @endif

                @yield('content')
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const viewport = document.getElementById('viewport');
            const toggleBtn = document.getElementById('toggle-sidebar');
            const openBtn = document.getElementById('open-sidebar');
            
            function updateSidebarState() {
                const isMobile = window.innerWidth <= 768;
                const isClosed = viewport.classList.contains('sidebar-closed');
                
                if (!isMobile && isClosed) {
                    openBtn.style.display = 'flex';
                } else {
                    openBtn.style.display = 'none';
                }
            }
            
            // Toggle sidebar closed
            toggleBtn.addEventListener('click', function() {
                const isMobile = window.innerWidth <= 768;
                
                if (isMobile) {
                    viewport.classList.toggle('sidebar-open');
                } else {
                    viewport.classList.add('sidebar-closed');
                    updateSidebarState();
                }
            });
            
            // Open sidebar
            openBtn.addEventListener('click', function() {
                viewport.classList.remove('sidebar-closed');
                updateSidebarState();
            });
            
            // Close sidebar on mobile when clicking outside
            document.addEventListener('click', function(e) {
                const isMobile = window.innerWidth <= 768;
                if (isMobile && !e.target.closest('#sidebar') && !e.target.closest('.toggle-btn')) {
                    viewport.classList.remove('sidebar-open');
                }
            });
            
            // Handle window resize
            window.addEventListener('resize', function() {
                updateSidebarState();
                if (window.innerWidth > 768) {
                    viewport.classList.remove('sidebar-open');
                }
            });
            
            // Initial state
            updateSidebarState();
        });
    </script>
</body>
</html>

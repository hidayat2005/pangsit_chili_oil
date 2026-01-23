<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pangsit Chili Oil - @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        /* STYLE UMUM */
        body, html {
            margin: 0;
            padding: 0;
            height: 100%;
            font-family: system-ui, -apple-system, sans-serif;
        }
        
        /* SIDEBAR STYLE */
        .sidebar {
            min-height: 100vh;
            background: linear-gradient(180deg, #dc3545 0%, #c82333 100%);
            color: white;
            box-shadow: 3px 0 10px rgba(0,0,0,0.1);
            position: fixed;
            width: 250px;
            z-index: 1000;
            display: flex;
            flex-direction: column;
        }
        
        .sidebar-header {
            padding: 20px;
            border-bottom: 1px solid rgba(255,255,255,0.2);
            text-align: center;
        }
        
        .sidebar-header h4 {
            color: white;
            font-weight: bold;
            margin: 0;
        }
        
        .sidebar-header p {
            color: rgba(255,255,255,0.8);
            font-size: 0.9rem;
            margin: 5px 0 0 0;
        }
        
        .sidebar-menu {
            padding: 20px 0;
            flex: 1;
        }
        
        .sidebar-menu a {
            color: rgba(255,255,255,0.9);
            text-decoration: none;
            padding: 12px 20px;
            display: block;
            transition: all 0.3s;
            border-left: 3px solid transparent;
        }
        
        .sidebar-menu a:hover {
            background-color: rgba(255,255,255,0.1);
            color: white;
            border-left: 3px solid white;
        }
        
        .sidebar-menu a.active {
            background-color: rgba(255,255,255,0.15);
            color: white;
            border-left: 3px solid white;
        }
        
        .sidebar-menu i {
            width: 20px;
            margin-right: 10px;
            text-align: center;
        }
        
        /* LOGOUT STYLE */
        .logout-form {
            padding: 20px;
            border-top: 1px solid rgba(255,255,255,0.2);
        }
        
        .logout-btn {
            background: none;
            border: none;
            color: rgba(255,255,255,0.9);
            text-align: left;
            padding: 12px 20px;
            cursor: pointer;
            display: flex;
            align-items: center;
            width: 100%;
            transition: all 0.3s;
        }
        
        .logout-btn:hover {
            background-color: rgba(255,255,255,0.1);
            color: white;
        }
        
        /* MAIN CONTENT STYLE */
        .main-content {
            margin-left: 250px;
            padding: 0;
            min-height: 100vh;
        }
        
        .top-navbar {
            background-color: white;
            padding: 15px 30px;
            border-bottom: 1px solid #dee2e6;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            position: sticky;
            top: 0;
            z-index: 999;
        }
        
        .content-wrapper {
            padding: 30px;
        }
        
        /* CARD STYLE */
        .card {
            border: none;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        }
        
        .card-header {
            background-color: white;
            border-bottom: 1px solid rgba(0,0,0,.125);
        }
        
        /* PRODUCT IMAGE STYLES */
        .product-img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 8px;
            border: 1px solid #dee2e6;
        }
        
        .product-img-lg {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 8px;
            border: 1px solid #dee2e6;
        }
        
        .product-img-detail {
            width: 100%;
            max-width: 300px;
            height: 300px;
            object-fit: cover;
            border-radius: 10px;
            border: 1px solid #dee2e6;
        }
        
        .img-preview {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 8px;
            border: 1px solid #dee2e6;
        }
        
        /* BADGE STYLES */
        .badge-category {
            font-size: 0.75rem;
            padding: 0.25rem 0.5rem;
        }
        
        .badge-stock {
            font-size: 0.75rem;
            padding: 0.25rem 0.5rem;
        }
        
        .badge-status {
            font-size: 0.75rem;
            padding: 0.25rem 0.5rem;
        }
        
        .table-actions { 
            white-space: nowrap; 
        }
        
        /* RESPONSIVE */
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                position: relative;
                min-height: auto;
            }
            
            .main-content {
                margin-left: 0;
            }
            
            .content-wrapper {
                padding: 20px;
            }
            
            .sidebar-menu a {
                padding: 10px 15px;
            }
            
            .logout-form {
                padding: 15px;
            }
        }
    </style>
</head>
<body>
    <!-- SIDEBAR -->
    <div class="sidebar">
        <div class="sidebar-header">
            <h4><i class="fas fa-utensils me-2"></i>PANGSIT CHILI OIL</h4>
            <p>Management System</p>
        </div>
        
       <div class="sidebar-menu">
    <!-- DASHBOARD -->
    <a href="{{ route('admin.dashboard') }}" 
       class="{{ request()->routeIs('admin.dashboard') || request()->routeIs('admin.index') ? 'active' : '' }}">
        <i class="fas fa-tachometer-alt"></i> Dashboard
    </a>
    
    <!-- Admin/Kasir - PERBAIKI: arahkan ke admin.users.index -->
    <a href="{{ route('admin.users.index') }}" 
       class="{{ request()->routeIs('admin.users*') ? 'active' : '' }}">
        <i class="fas fa-users-cog"></i> Admin/Kasir
    </a>
    
    <!-- Kategori -->
    <a href="{{ route('admin.kategori.index') }}" 
       class="{{ request()->routeIs('admin.kategori*') ? 'active' : '' }}">
        <i class="fas fa-tags"></i> Kategori
    </a>
    
    <!-- Produk -->
    <a href="{{ route('admin.produk.index') }}" 
       class="{{ request()->routeIs('admin.produk*') ? 'active' : '' }}">
        <i class="fas fa-box"></i> Produk
    </a>
    
    <!-- PELANGGAN -->
    <a href="{{ route('admin.pelanggan.index') }}" 
       class="{{ request()->routeIs('admin.pelanggan*') ? 'active' : '' }}">
        <i class="fas fa-users"></i> Pelanggan
    </a>
</div>
        
        <!-- LOGOUT FORM YANG BENAR -->
        <div class="logout-form">
            <form action="{{ route('logout') }}" method="POST" class="mb-0">
                @csrf
                <button type="submit" class="logout-btn">
                    <i class="fas fa-sign-out-alt me-2"></i> Logout
                </button>
            </form>
        </div>
    </div>
    
    <!-- MAIN CONTENT -->
    <div class="main-content">
        <!-- TOP NAVBAR -->
        <div class="top-navbar">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0">@yield('title')</h5>
                <div class="d-flex align-items-center">
                    <span class="me-3 text-muted">
                        <i class="fas fa-user-circle me-1"></i>
                        {{ Auth::user()->name ?? 'User' }}
                    </span>
                    <span class="badge bg-danger">System</span>
                </div>
            </div>
        </div>
        
        <!-- CONTENT WRAPPER -->
        <div class="content-wrapper">
            <!-- NOTIFICATIONS -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    <i class="fas fa-check-circle me-2"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            
            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            
            <!-- CONTENT -->
            @yield('content')
        </div>
    </div>

    <!-- SCRIPTS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <!-- SweetAlert2 untuk konfirmasi delete -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Konfirmasi delete
        $(document).on('submit', 'form[action*="destroy"]', function(e) {
            e.preventDefault();
            var form = this;
            
            Swal.fire({
                title: 'Hapus Data?',
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
        
        // Auto-hide alerts setelah 5 detik
        $(document).ready(function() {
            setTimeout(function() {
                $('.alert').alert('close');
            }, 5000);
        });
    </script>
    
    @stack('scripts')
</body>
</html>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pangsit Chili Oil - @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        /* HILANGKAN DEFAULT MARGIN DAN PADDING */
        body, html {
            margin: 0;
            padding: 0;
            overflow-x: hidden;
            height: 100%;
        }
        
        /* NAVBAR DENGAN TULISAN MEPET KANAN KIRI */
        .navbar {
            padding: 0.5rem 0;
        }
        
        .navbar .container {
            padding: 0 15px;
            width: 100%;
            max-width: 100%;
        }
        
        .navbar-brand { 
            font-weight: bold;
            padding: 0.5rem 0;
            margin: 0;
        }
        
        .navbar-nav {
            margin: 0;
        }
        
        .navbar-nav .nav-link {
            padding: 0.5rem 1rem;
            margin: 0 2px;
        }
        
        /* GAMBAR PRODUK */
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
        
        /* BADGE STYLING */
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
        
        /* NAVBAR TOGGLER */
        .navbar-toggler {
            margin: 0;
            padding: 0.25rem 0.5rem;
        }
        
        /* HAPUS PADDING DARI MAIN CONTENT */
        .main-content {
            padding: 0 !important;
            margin: 0 !important;
        }
        
        /* TABLE ACTIONS */
        .table-actions { 
            white-space: nowrap; 
        }
        
        /* CARD STYLING */
        .card {
            border: none;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        }
        
        .card-header {
            background-color: white;
            border-bottom: 1px solid rgba(0,0,0,.125);
        }
        
        .nav-link.active {
            font-weight: bold;
            background-color: rgba(255,255,255,0.1);
            border-radius: 5px;
        }
        
        /* RESPONSIVE */
        @media (max-width: 768px) {
            .navbar-brand {
                font-size: 1rem;
            }
            
            .navbar-nav .nav-link {
                padding: 0.5rem 0.75rem;
            }
            
            .navbar-collapse {
                padding: 0.5rem 0;
            }
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">
    <!-- NAVBAR DENGAN PADDING MINIMAL -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-danger">
        <div class="container-fluid px-3">
            <!-- BRAND MEPET KIRI -->
            <a class="navbar-brand" href="{{ url('/') }}">
                <i class="fas fa-utensils me-2"></i>PANGSIT CHILI OIL
            </a>
            
            <!-- TOGGLER BUTTON -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <!-- NAV LINKS MEPET KANAN -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <div class="navbar-nav ms-auto">
                    <a class="nav-link {{ request()->is('kategori*') ? 'active' : '' }}" 
                       href="{{ route('kategori.index') }}">
                        <i class="fas fa-tags me-1"></i>Kategori
                    </a>
                    <a class="nav-link {{ request()->is('produk*') ? 'active' : '' }}" 
                       href="{{ route('produk.index') }}">
                        <i class="fas fa-box me-1"></i>Produk
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- MAIN CONTENT - TANPA CONTAINER UNTUK FULL SCREEN -->
    <div class="main-content flex-grow-1">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    @stack('scripts')
</body>
</html>
@extends('frontend.layouts.front')

@section('title', 'Produk - Pangsit Chili Oil')

@section('content')
    <!-- HERO BANNER PRODUK -->
    <section class="hero-section" style="background: linear-gradient(rgba(74, 44, 42, 0.9), rgba(178, 34, 34, 0.8)), url('{{ asset('images/All Pangsit Chili Oil .webp') }}'); background-size: cover; background-position: center;">
        <div class="container">
            <div class="row min-vh-50 align-items-center">
                <div class="col-lg-8 mx-auto text-center text-white">
                    <h1 class="display-4 fw-bold mb-4">Menu <span class="text-warning">Pangsit Chili Oil</span></h1>
                    <p class="lead mb-4">Temukan berbagai varian pangsit crispy dengan chili oil autentik yang menggugah selera.</p>
                    
                    <!-- Search Form -->
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <form action="{{ route('front.products') }}" method="GET" class="bg-white rounded-pill p-2 shadow">
                                <div class="input-group">
                                    <input type="text" 
                                           name="search" 
                                           class="form-control border-0 rounded-pill ps-4" 
                                           placeholder="Cari produk..." 
                                           value="{{ request('search') }}">
                                    <button class="btn btn-danger rounded-pill px-4" type="submit">
                                        <i class="fas fa-search"></i> Cari
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- PRODUCTS SECTION -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row mb-5">
                <div class="col-12">
                    <!-- Filter & Sort -->
                    <div class="row align-items-center">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <h2 class="fw-bold text-danger mb-0">Semua Produk</h2>
                            <p class="text-muted mb-0">{{ $products->total() ?? '0' }} produk ditemukan</p>
                        </div>
                        <div class="col-md-6 text-md-end">
                            <div class="d-flex justify-content-md-end gap-2">
                                <!-- Category Filter -->
                                <div class="dropdown">
                                    <button class="btn btn-outline-danger dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                        <i class="fas fa-filter me-2"></i>Kategori
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a class="dropdown-item {{ !request('category') ? 'active' : '' }}" 
                                               href="{{ route('front.products', array_merge(request()->except('category'), request()->only(['search', 'sort']))) }}">
                                                Semua Kategori
                                            </a>
                                        </li>
                                        @if(isset($categories) && $categories->count() > 0)
                                            @foreach($categories as $category)
                                            <li>
                                                <a class="dropdown-item {{ request('category') == $category->id ? 'active' : '' }}" 
                                                   href="{{ route('front.products', array_merge(['category' => $category->id], request()->only(['search', 'sort']))) }}">
                                                    {{ $category->nama_kategori }} ({{ $category->produk_count ?? 0 }})
                                                </a>
                                            </li>
                                            @endforeach
                                        @endif
                                    </ul>
                                </div>
                                
                                <!-- Sort -->
                                <div class="dropdown">
                                    <button class="btn btn-outline-danger dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                        <i class="fas fa-sort me-2"></i>Urutkan
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a class="dropdown-item {{ request('sort', 'newest') == 'newest' ? 'active' : '' }}" 
                                               href="{{ route('front.products', array_merge(['sort' => 'newest'], request()->only(['search', 'category']))) }}">
                                                <i class="fas fa-clock me-2"></i>Terbaru
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item {{ request('sort') == 'price_low' ? 'active' : '' }}" 
                                               href="{{ route('front.products', array_merge(['sort' => 'price_low'], request()->only(['search', 'category']))) }}">
                                                <i class="fas fa-arrow-down me-2"></i>Harga Terendah
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item {{ request('sort') == 'price_high' ? 'active' : '' }}" 
                                               href="{{ route('front.products', array_merge(['sort' => 'price_high'], request()->only(['search', 'category']))) }}">
                                                <i class="fas fa-arrow-up me-2"></i>Harga Tertinggi
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item {{ request('sort') == 'popular' ? 'active' : '' }}" 
                                               href="{{ route('front.products', array_merge(['sort' => 'popular'], request()->only(['search', 'category']))) }}">
                                                <i class="fas fa-fire me-2"></i>Terlaris
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Products Grid -->
            <div class="row">
                @if(isset($products) && $products->count() > 0)
                    @foreach($products as $product)
                        @include('frontend.partials.product-card', ['product' => $product])
                    @endforeach
                @else
                <div class="col-12 text-center py-5">
                    <div class="py-4">
                        <i class="fas fa-search fa-4x text-danger mb-4"></i>
                        <h4 class="text-danger mb-3">Produk tidak ditemukan</h4>
                        <p class="text-muted mb-4">Coba kata kunci lain atau lihat kategori produk</p>
                        <a href="{{ route('front.products') }}" class="btn btn-danger">
                            <i class="fas fa-redo me-2"></i> Reset Pencarian
                        </a>
                    </div>
                </div>
                @endif
            </div>
            
            <!-- Pagination -->
            @if(isset($products) && $products->hasPages())
            <div class="row mt-5">
                <div class="col-12">
                    <nav aria-label="Product pagination">
                        <ul class="pagination justify-content-center">
                            {{ $products->links() }}
                        </ul>
                    </nav>
                </div>
            </div>
            @endif
        </div>
    </section>

    <!-- CATEGORIES SECTION -->
    <section class="py-5 bg-white">
        <div class="container">
            <div class="row mb-5">
                <div class="col-12 text-center">
                    <span class="badge bg-danger rounded-pill px-3 py-2 mb-3">Kategori</span>
                    <h2 class="fw-bold mb-3 text-danger">Kategori Produk</h2>
                    <p class="text-muted">Temukan produk berdasarkan kategori favorit Anda</p>
                </div>
            </div>
            
            <div class="row g-4">
                @if(isset($categories) && $categories->count() > 0)
                    @foreach($categories as $category)
                    <div class="col-lg-3 col-md-6">
                        <a href="{{ route('front.products', ['category' => $category->id]) }}" 
                           class="text-decoration-none">
                            <div class="card glass-card h-100 text-center p-4 category-card">
                                <div class="icon-wrapper mb-3">
                                    <div class="rounded-circle bg-danger bg-opacity-10 d-inline-flex align-items-center justify-content-center" 
                                         style="width: 100px; height: 100px;">
                                        @php
                                            $icon = 'fa-utensils';
                                            $name = strtolower($category->nama_kategori);
                                            if (str_contains($name, 'original')) $icon = 'fa-utensils';
                                            elseif (str_contains($name, 'pedas')) $icon = 'fa-pepper-hot';
                                            elseif (str_contains($name, 'chili')) $icon = 'fa-fire-alt';
                                            elseif (str_contains($name, 'kombo') || str_contains($name, 'paket')) $icon = 'fa-boxes';
                                        @endphp
                                        <i class="fas {{ $icon }} fa-3x text-danger"></i>
                                    </div>
                                </div>
                                <h5 class="fw-bold mb-2 text-dark">{{ $category->nama_kategori }}</h5>
                                <p class="text-muted small mb-0">
                                    {{ $category->produk_count ?? 0 }} produk
                                </p>
                            </div>
                        </a>
                    </div>
                    @endforeach
                @else
                <div class="col-12 text-center py-4">
                    <p class="text-muted">Belum ada kategori tersedia</p>
                </div>
                @endif
            </div>
        </div>
    </section>
@endsection

@push('styles')
<style>
    .min-vh-50 {
        min-height: 50vh;
    }
    
    .category-card {
        transition: all 0.3s ease;
        border-radius: 15px;
        overflow: hidden;
    }
    
    .category-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(220, 53, 69, 0.1);
    }
    
    .category-card:hover .icon-wrapper {
        transform: scale(1.1);
    }
    
    .icon-wrapper {
        transition: transform 0.3s;
    }
    
    .btn-outline-danger:hover {
        background-color: var(--primary-red);
        color: white;
    }
</style>
@endpush

@push('scripts')
<script>
    $(document).ready(function() {
        // Page specific initialization if needed
    });
</script>
@endpush
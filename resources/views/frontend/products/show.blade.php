@extends('frontend.layouts.front')

@section('title', $product->nama_produk . ' - Pangsit Chili Oil')

@section('content')
    <!-- BREADCRUMB -->
    <section class="py-3 bg-light">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-danger">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('front.products') }}" class="text-danger">Produk</a></li>
                    @if($product->kategori)
                    <li class="breadcrumb-item"><a href="{{ route('front.products.category', $product->kategori_id) }}" class="text-danger">{{ $product->kategori->nama_kategori }}</a></li>
                    @endif
                    <li class="breadcrumb-item active" aria-current="page">{{ $product->nama_produk }}</li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- PRODUCT DETAIL -->
    <section class="py-5">
        <div class="container">
            <div class="row">
                <!-- Product Image -->
                <div class="col-lg-6 mb-4 mb-lg-0" data-aos="fade-right">
                    <div class="card border-0 shadow-sm overflow-hidden rounded-3">
                        @if($product->gambar)
                            <img src="{{ asset('storage/' . $product->gambar) }}" 
                                 class="img-fluid w-100" 
                                 alt="{{ $product->nama_produk }}"
                                 style="max-height: 500px; object-fit: cover;"
                                 loading="lazy">
                        @else
                            <div class="bg-danger bg-opacity-10 d-flex align-items-center justify-content-center" style="height: 500px;">
                                <i class="fas fa-image fa-5x text-danger opacity-50"></i>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Product Info -->
                <div class="col-lg-6" data-aos="fade-left" data-aos-delay="200">
                    <div class="product-info">
                        <!-- Category Badge -->
                        @if($product->kategori)
                        <div class="mb-3">
                            <a href="{{ route('front.products.category', $product->kategori_id) }}" class="badge bg-danger bg-opacity-10 text-danger border border-danger text-decoration-none">
                                <i class="fas fa-tag me-1"></i> {{ $product->kategori->nama_kategori }}
                            </a>
                        </div>
                        @endif

                        <!-- Product Name -->
                        <h1 class="fw-bold mb-3 text-dark">{{ $product->nama_produk }}</h1>

                        <!-- Price -->
                        <div class="mb-4">
                            <h2 class="text-danger fw-bold mb-0">Rp {{ number_format($product->harga, 0, ',', '.') }}</h2>
                        </div>

                        <!-- Stock Status -->
                        <div class="mb-4">
                            <div class="d-flex align-items-center">
                                <span class="me-2 text-muted">Stok:</span>
                                @if($product->stok > 0)
                                    <span class="badge {{ $product->stok > 10 ? 'bg-success' : 'bg-warning' }}">
                                        {{ $product->stok }} tersedia
                                    </span>
                                @else
                                    <span class="badge bg-danger">Habis</span>
                                @endif
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="mb-4">
                            <h5 class="fw-bold mb-3">Deskripsi Produk</h5>
                            <p class="text-muted" style="text-align: justify;">{{ $product->deskripsi }}</p>
                        </div>

                        <!-- Divider -->
                        <hr class="my-4">

                        <!-- Add to Cart Section -->
                        @if($product->stok > 0)
                        <div class="card border-danger bg-danger bg-opacity-5 p-4 rounded-3">
                            <div class="row align-items-center">
                                <div class="col-md-4 mb-3 mb-md-0">
                                    <label class="form-label fw-bold text-dark mb-2">Jumlah</label>
                                    <div class="input-group">
                                        <button class="btn btn-outline-danger" type="button" id="decrease-qty">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        <input type="number" 
                                               class="form-control text-center fw-bold" 
                                               id="quantity" 
                                               value="1" 
                                               min="1" 
                                               max="{{ $product->stok }}"
                                               readonly>
                                        <button class="btn btn-outline-danger" type="button" id="increase-qty">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                    <small class="text-muted">Max: {{ $product->stok }}</small>
                                </div>
                                <div class="col-md-8">
                                    <button class="btn btn-danger btn-lg w-100 fw-bold" id="add-to-cart-btn" data-product-id="{{ $product->id }}">
                                        <i class="fas fa-shopping-cart me-2"></i>
                                        Tambah ke Keranjang
                                    </button>
                                </div>
                            </div>
                        </div>
                        @else
                        <div class="alert alert-danger">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            <strong>Maaf!</strong> Produk ini sedang habis. Silakan hubungi kami untuk ketersediaan.
                        </div>
                        @endif

                        <!-- Additional Info -->
                        <div class="mt-4">
                            <div class="row g-3">
                                <div class="col-6">
                                    <div class="d-flex align-items-center text-muted">
                                        <i class="fas fa-truck me-2 text-danger"></i>
                                        <small>Pengiriman Cepat</small>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="d-flex align-items-center text-muted">
                                        <i class="fas fa-shield-alt me-2 text-danger"></i>
                                        <small>Dijamin Segar</small>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="d-flex align-items-center text-muted">
                                        <i class="fas fa-leaf me-2 text-danger"></i>
                                        <small>Bahan Premium</small>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="d-flex align-items-center text-muted">
                                        <i class="fas fa-certificate me-2 text-danger"></i>
                                        <small>Kualitas Terjamin</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- RELATED PRODUCTS -->
    @if($relatedProducts->count() > 0)
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row mb-4" data-aos="fade-up">
                <div class="col-12">
                    <h3 class="fw-bold text-danger mb-0">Produk Terkait</h3>
                    <p class="text-muted">Produk lain yang mungkin Anda suka</p>
                </div>
            </div>
            
            <div class="row">
                @foreach($relatedProducts as $relatedProduct)
                    @include('frontend.partials.product-card', ['product' => $relatedProduct])
                @endforeach
            </div>
        </div>
    </section>
    @endif
@endsection

@push('styles')
<style>
    .breadcrumb-item + .breadcrumb-item::before {
        color: #6c757d;
    }
    
    .breadcrumb-item a:hover {
        text-decoration: underline;
    }
    
    .product-info {
        position: sticky;
        top: 20px;
    }
    
    #quantity {
        background-color: white;
        border-left: none;
        border-right: none;
    }
    
    #quantity:focus {
        box-shadow: none;
        border-color: #dc3545;
    }
    
    .input-group .btn-outline-danger:hover {
        background-color: #dc3545;
        border-color: #dc3545;
        color: white;
    }
</style>
@endpush

@push('scripts')
<script>
    $(document).ready(function() {
        const maxStock = {{ $product->stok }};
        
        // Decrease quantity
        $('#decrease-qty').click(function() {
            const currentQty = parseInt($('#quantity').val());
            if (currentQty > 1) {
                $('#quantity').val(currentQty - 1);
            }
        });
        
        // Increase quantity
        $('#increase-qty').click(function() {
            const currentQty = parseInt($('#quantity').val());
            if (currentQty < maxStock) {
                $('#quantity').val(currentQty + 1);
            }
        });
        
        // Add to cart with quantity
        $('#add-to-cart-btn').click(function(e) {
            e.preventDefault();
            const productId = $(this).data('product-id');
            const quantity = parseInt($('#quantity').val());
            
            if (typeof window.addToCart === 'function') {
                window.addToCart(productId, quantity);
            } else {
                alert('Fungsi keranjang belum tersedia!');
            }
        });
        
        // Page specific initialization if needed
    });
</script>
@endpush

@extends('frontend.layouts.front')

@section('title', 'Keranjang Belanja - Pangsit Chili Oil')

@section('content')
    <!-- HERO BANNER CART -->
    <section class="hero-section" style="background: linear-gradient(rgba(220, 53, 69, 0.8), rgba(178, 34, 34, 0.9)), url('https://images.unsplash.com/photo-1607082348824-0a96f2a4b9da?ixlib=rb-4.0.3&auto=format&fit=crop&w=2080&q=80'); background-size: cover; background-position: center;">
        <div class="container">
            <div class="row min-vh-40 align-items-center">
                <div class="col-lg-8 mx-auto text-center text-white">
                    <h1 class="display-4 fw-bold mb-4">Keranjang <span class="text-warning">Belanja</span></h1>
                    <p class="lead mb-4">Periksa dan selesaikan pesanan Anda</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CART SECTION -->
    <section class="py-5 bg-light">
        <div class="container">
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show mb-4">
                <i class="fas fa-check-circle me-2"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif

            @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show mb-4">
                <i class="fas fa-exclamation-circle me-2"></i>
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif

            <div class="row">
                <div class="col-lg-8">
                    <!-- Cart Items -->
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header bg-white border-0 py-3">
                            <h4 class="fw-bold text-danger mb-0">
                                <i class="fas fa-shopping-bag me-2"></i>Produk di Keranjang
                            </h4>
                        </div>
                        <div class="card-body p-0">
                            @php
                                // Pastikan $cartItems terdefinisi
                                $cartItems = $cartItems ?? [];
                            @endphp
                            
                            @if(count($cartItems) > 0)
                                <div class="table-responsive">
                                    <table class="table table-hover mb-0">
                                        <thead class="table-light">
                                            <tr>
                                                <th scope="col" class="border-0">Produk</th>
                                                <th scope="col" class="border-0 text-center">Harga</th>
                                                <th scope="col" class="border-0 text-center">Kuantitas</th>
                                                <th scope="col" class="border-0 text-center">Subtotal</th>
                                                <th scope="col" class="border-0 text-center">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $total = 0;
                                            @endphp
                                            
                                            @foreach($cartItems as $cartItem)
                                                @php
                                                    // Akses sebagai array key, bukan object property
                                                    $product = $cartItem['product']; // Object Produk
                                                    $quantity = $cartItem['quantity']; // Integer
                                                    $subtotal = $cartItem['subtotal']; // Integer
                                                    $total += $subtotal; // Tambah ke total
                                                @endphp
                                                <tr>
                                                    <td class="align-middle">
                                                        <div class="d-flex align-items-center">
                                                            <div class="flex-shrink-0 me-3">
                                                                @if($product->gambar)
                                                                <img src="{{ asset('storage/' . $product->gambar) }}" 
                                                                     alt="{{ $product->nama_produk }}"
                                                                     class="rounded" 
                                                                     width="80" 
                                                                     height="80"
                                                                     style="object-fit: cover">
                                                                @else
                                                                <div class="bg-danger bg-opacity-10 rounded d-flex align-items-center justify-content-center" 
                                                                     style="width: 80px; height: 80px">
                                                                    <i class="fas fa-image text-danger"></i>
                                                                </div>
                                                                @endif
                                                            </div>
                                                            <div class="flex-grow-1">
                                                                <h6 class="fw-bold mb-1">{{ $product->nama_produk }}</h6>
                                                                @if($product->kategori)
                                                                <small class="text-muted">
                                                                    <span class="badge bg-danger bg-opacity-10 text-danger">
                                                                        {{ $product->kategori->nama_kategori }}
                                                                    </span>
                                                                </small>
                                                                @endif
                                                                <div class="mt-1">
                                                                    <small class="text-muted">
                                                                        Stok: <span class="badge {{ $product->stok > 4 ? 'bg-success' : ($product->stok > 0 ? 'bg-warning' : 'bg-danger') }}">
                                                                            {{ $product->stok }}
                                                                        </span>
                                                                        @if($quantity > $product->stok)
                                                                            <span class="badge bg-danger ms-1">Stok kurang!</span>
                                                                        @endif
                                                                    </small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="align-middle text-center">
                                                        <span class="fw-bold text-danger">Rp {{ number_format($product->harga, 0, ',', '.') }}</span>
                                                    </td>
                                                    <td class="align-middle text-center">
                                                        <div class="d-flex align-items-center justify-content-center">
                                                           <form action="{{ route('cart.update', ['id' => $product->id]) }}" method="POST" class="d-flex">
                                                                @csrf
                                                                @method('PUT')
                                                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                                <button type="submit" 
                                                                        name="action" 
                                                                        value="decrease" 
                                                                        class="btn btn-sm btn-outline-danger rounded-circle"
                                                                        {{ $quantity <= 1 ? 'disabled' : '' }}
                                                                        style="width: 30px; height: 30px">
                                                                    <i class="fas fa-minus"></i>
                                                                </button>
                                                                <input type="number" 
                                                                       name="quantity" 
                                                                       value="{{ $quantity }}" 
                                                                       min="1" 
                                                                       max="{{ $product->stok }}"
                                                                       class="form-control form-control-sm mx-2 text-center" 
                                                                       style="width: 60px"
                                                                       onchange="this.form.submit()">
                                                                <button type="submit" 
                                                                        name="action" 
                                                                        value="increase" 
                                                                        class="btn btn-sm btn-outline-danger rounded-circle"
                                                                        {{ $quantity >= $product->stok ? 'disabled' : '' }}
                                                                        style="width: 30px; height: 30px">
                                                                    <i class="fas fa-plus"></i>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                    <td class="align-middle text-center">
                                                        <span class="fw-bold text-danger">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                                                    </td>
                                                    <td class="align-middle text-center">
                                                        <form action="{{ route('cart.remove', ['id' => $product->id]) }}" method="POST" class="d-flex">
                                                            @csrf
                                                            @method('DELETE')
                                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                            <button type="submit" 
                                                                    class="btn btn-sm btn-outline-danger"
                                                                    onclick="return confirm('Hapus produk dari keranjang?')">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                            <div class="text-center py-5">
                                <div class="py-4">
                                    <i class="fas fa-shopping-cart fa-4x text-danger mb-4"></i>
                                    <h4 class="text-danger mb-3">Keranjang Kosong</h4>
                                    <p class="text-muted mb-4">Tambahkan produk ke keranjang untuk melanjutkan</p>
                                    <a href="{{ route('front.products') }}" class="btn btn-danger btn-lg">
                                        <i class="fas fa-shopping-bag me-2"></i>Belanja Sekarang
                                    </a>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Continue Shopping -->
                    @if(count($cartItems) > 0)
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('front.products') }}" class="btn btn-outline-danger">
                            <i class="fas fa-arrow-left me-2"></i>Lanjutkan Belanja
                        </a>
                        <form action="{{ route('cart.clear') }}" method="POST">
                            @csrf
                            <button type="submit" 
                                    class="btn btn-outline-secondary"
                                    onclick="return confirm('Hapus semua item dari keranjang?')">
                                <i class="fas fa-trash me-2"></i>Kosongkan Keranjang
                            </button>
                        </form>
                    </div>
                    @endif
                </div>

                <!-- Order Summary -->
                <div class="col-lg-4">
                    <div class="card border-0 shadow-sm sticky-top" style="top: 100px;">
                        <div class="card-header bg-danger text-white border-0 py-3">
                            <h4 class="fw-bold mb-0">
                                <i class="fas fa-receipt me-2"></i>Ringkasan Pesanan
                            </h4>
                        </div>
                        <div class="card-body">
                            @if(count($cartItems) > 0)
                            @php
                                $subtotal = $total ?? 0;
                            @endphp
                            <div class="mb-3">
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="text-muted">Subtotal</span>
                                    <span class="fw-bold">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="text-muted">Ongkir</span>
                                    <span class="fw-bold text-success">Gratis</span>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="text-muted">Biaya Layanan</span>
                                    <span class="fw-bold">Rp 2.000</span>
                                </div>
                                <hr>
                                <div class="d-flex justify-content-between mb-3">
                                    <span class="fw-bold">Total</span>
                                    <h4 class="fw-bold text-danger mb-0">Rp {{ number_format($subtotal + 2000, 0, ',', '.') }}</h4>
                                </div>
                            </div>

                            <!-- Checkout Button -->
                            @if(isset($checkoutRoute) && $checkoutRoute)
                            <a href="{{ route($checkoutRoute) }}" class="btn btn-danger btn-lg w-100 py-3 mb-3">
                                <i class="fas fa-lock me-2"></i>Proses Checkout
                            </a>
                            @else
                            <a href="#" class="btn btn-secondary btn-lg w-100 py-3 mb-3 disabled">
                                <i class="fas fa-lock me-2"></i>Checkout (Coming Soon)
                            </a>
                            @endif

                            <!-- Payment Methods -->
                            <div class="border-top pt-3">
                                <h6 class="fw-bold mb-3">Metode Pembayaran</h6>
                                <div class="row g-2">
                                    <div class="col-4">
                                        <div class="border rounded text-center p-2">
                                            <i class="fas fa-university text-danger mb-1"></i>
                                            <small>Transfer Bank</small>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="border rounded text-center p-2">
                                            <i class="fab fa-gopay text-danger mb-1"></i>
                                            <small>Gopay</small>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="border rounded text-center p-2">
                                            <i class="fas fa-money-bill text-danger mb-1"></i>
                                            <small>COD</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @else
                            <div class="text-center py-4">
                                <p class="text-muted mb-0">Tambahkan produk untuk melihat ringkasan</p>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- RECOMMENDED PRODUCTS -->
    @if(count($cartItems) > 0)
    <section class="py-5 bg-white">
        <div class="container">
            <div class="row mb-4">
                <div class="col-12">
                    <h3 class="fw-bold text-danger">
                        <i class="fas fa-fire me-2"></i>Rekomendasi Untuk Anda
                    </h3>
                    <p class="text-muted">Produk lain yang mungkin Anda sukai</p>
                </div>
            </div>
            
            <div class="row">
                @php
                    $recommendedProducts = \App\Models\Produk::where('status', 'tersedia')
                        ->where('stok', '>', 0)
                        ->inRandomOrder()
                        ->take(4)
                        ->get();
                @endphp
                
                @foreach($recommendedProducts as $product)
                <div class="col-lg-3 col-md-6">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="position-relative" style="height: 150px; overflow: hidden;">
                            @if($product->gambar)
                            <img src="{{ asset('storage/' . $product->gambar) }}" 
                                 class="w-100 h-100 object-fit-cover" 
                                 alt="{{ $product->nama_produk }}">
                            @else
                            <div class="w-100 h-100 bg-danger bg-opacity-10 d-flex align-items-center justify-content-center">
                                <i class="fas fa-image fa-2x text-danger"></i>
                            </div>
                            @endif
                        </div>
                        <div class="card-body p-3">
                            <h6 class="fw-bold mb-1">{{ Str::limit($product->nama_produk, 30) }}</h6>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="text-danger fw-bold">Rp {{ number_format($product->harga, 0, ',', '.') }}</span>
                                <button class="btn btn-danger btn-sm rounded-circle cart-button" 
                                        data-product-id="{{ $product->id }}"
                                        style="width: 30px; height: 30px;">
                                    <i class="fas fa-cart-plus"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif
@endsection

@push('styles')
<style>
    .min-vh-40 {
        min-height: 40vh;
    }
    
    .table th {
        font-weight: 600;
        color: var(--dark-brown);
    }
    
    .table td {
        vertical-align: middle;
    }
    
    .sticky-top {
        z-index: 1020;
    }
    
    input[type="number"]::-webkit-inner-spin-button,
    input[type="number"]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
    
    .btn-outline-danger:hover {
        background-color: var(--primary-red);
        color: white;
    }
    
    .cart-button {
        transition: all 0.3s;
    }
    
    .cart-button:hover {
        transform: scale(1.1);
    }
</style>
@endpush

@push('scripts')
<script>
    $(document).ready(function() {
        // Handle add to cart button clicks in recommended products
        $('.cart-button').click(function(e) {
            e.preventDefault();
            var productId = $(this).data('product-id');
            
            if (typeof window.addToCart === 'function') {
                window.addToCart(productId);
            }
        });
        
        // Auto update quantity when changed
        $('input[name="quantity"]').on('change', function() {
            if ($(this).val() < 1) {
                $(this).val(1);
            }
        });
    });
</script>
@endpush
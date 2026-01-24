@if(!isset($noWrapper) || !$noWrapper)
<div class="col-xl-3 col-lg-4 col-md-6 mb-4" data-aos="fade-up">
@endif
    <div class="card product-card glass-card h-100">
        <!-- Badge Stok -->
        @if($product->stok == 0)
        <div class="position-absolute top-0 start-0 m-3" style="z-index: 10;">
            <span class="badge bg-secondary">Habis</span>
        </div>
        @elseif($product->stok < 5)
        <div class="position-absolute top-0 start-0 m-3" style="z-index: 10;">
            <span class="badge bg-warning">Hampir Habis</span>
        </div>
        @endif
        
        <!-- Product Image - Clickable -->
        <a href="{{ route('front.product.show', $product->id) }}" class="text-decoration-none">
            <div class="product-image-container position-relative" style="height: 200px; overflow: hidden;">
                @if($product->gambar)
                    <img src="{{ asset('storage/' . $product->gambar) }}" 
                         class="w-100 h-100 object-fit-cover" 
                         alt="{{ $product->nama_produk }}"
                         loading="lazy">
                @else
                    <div class="w-100 h-100 bg-danger bg-opacity-10 d-flex align-items-center justify-content-center">
                        <i class="fas fa-image fa-3x text-danger"></i>
                    </div>
                @endif
                <div class="product-overlay"></div>
            </div>
        </a>
        
        <!-- Product Info -->
        <div class="card-body p-4 d-flex flex-column">
            <!-- Category -->
            @if($product->kategori)
            <div class="mb-2">
                <a href="{{ route('front.products.category', $product->kategori_id) }}" class="badge bg-danger bg-opacity-10 text-danger border border-danger text-decoration-none">
                    {{ $product->kategori->nama_kategori }}
                </a>
            </div>
            @endif
            
            <!-- Name - Clickable -->
            <a href="{{ route('front.product.show', $product->id) }}" class="text-decoration-none">
                <h5 class="card-title fw-bold mb-2 text-dark product-title">{{ $product->nama_produk }}</h5>
            </a>
            
            <!-- Description -->
            <p class="card-text text-muted small mb-3">
                {{ Str::limit($product->deskripsi, 60) }}
            </p>
            
            <!-- Price & Stock - Pushed to bottom -->
            <div class="mt-auto d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="text-danger fw-bold mb-0">Rp {{ number_format($product->harga, 0, ',', '.') }}</h4>
                    <small class="text-muted">
                        Stok: 
                        <span class="badge {{ $product->stok > 4 ? 'bg-success' : ($product->stok > 0 ? 'bg-warning' : 'bg-danger') }}">
                            {{ $product->stok }}
                        </span>
                    </small>
                </div>
                
                <!-- Actions -->
                @if($product->stok > 0)
                <div class="d-flex gap-2">
                    <button class="btn btn-outline-danger btn-sm rounded-pill px-3 buy-button" 
                            data-product-id="{{ $product->id }}"
                            title="Beli Sekarang">
                        Beli
                    </button>
                    <button class="btn btn-danger btn-sm rounded-circle cart-button" 
                            data-product-id="{{ $product->id }}"
                            style="width: 40px; height: 40px; flex-shrink: 0;"
                            title="Tambah ke Keranjang">
                        <i class="fas fa-cart-plus"></i>
                    </button>
                </div>
                @else
                <button class="btn btn-secondary btn-sm rounded-pill px-3" 
                        disabled
                        title="Stok Habis">
                    Habis
                </button>
                @endif
            </div>
        </div>
    </div>
@if(!isset($noWrapper) || !$noWrapper)
</div>
@endif

@once
@push('styles')
<style>
    .product-card {
        transition: all 0.3s ease;
    }
    
    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(220, 53, 69, 0.15) !important;
    }
    
    .product-title:hover {
        color: #dc3545 !important;
    }
    
    .product-image-container {
        transition: transform 0.3s ease;
    }
    
    .product-card:hover .product-image-container img {
        transform: scale(1.05);
    }
    
    .object-fit-cover {
        object-fit: cover;
        transition: transform 0.3s ease;
    }
</style>
@endpush
@endonce
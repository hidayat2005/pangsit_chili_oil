@if(isset($products) && $products->count() > 0)
<div class="row mb-5">
    <div class="col-12 text-center">
        @if(isset($title))
        <span class="badge bg-danger rounded-pill px-3 py-2 mb-3">{{ $title }}</span>
        @endif
        
        @if(isset($heading))
        <h2 class="fw-bold mb-3 text-danger">{{ $heading }}</h2>
        @endif
        
        @if(isset($subtitle))
        <p class="text-muted">{{ $subtitle }}</p>
        @endif
    </div>
</div>

<div class="row">
    @foreach($products as $product)
        @include('frontend.partials.product-card', ['product' => $product])
    @endforeach
</div>

@if(isset($showViewAll) && $showViewAll)
<div class="text-center mt-5">
    <a href="{{ route('front.products') }}" class="btn btn-outline-danger btn-lg px-5 py-3">
        Lihat Semua Produk <i class="fas fa-arrow-right ms-2"></i>
    </a>
</div>
@endif

@else
<div class="col-12 text-center py-5">
    <div class="py-4">
        <i class="fas fa-box-open fa-4x text-danger mb-4"></i>
        <h4 class="text-danger mb-3">Belum ada produk</h4>
        <p class="text-muted mb-4">Produk sedang dalam persiapan</p>
    </div>
</div>
@endif
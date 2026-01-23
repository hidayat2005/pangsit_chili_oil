@extends('frontend.layouts.front')

@section('title', 'Keranjang Belanja - Pangsit Chili Oil')

@section('content')
    <!-- HERO BANNER CART -->
    <section class="hero-section" style="background: linear-gradient(rgba(220, 53, 69, 0.8), rgba(178, 34, 34, 0.9)), url('{{ asset('images/Image Halaman Keranjang.webp') }}'); background-size: cover; background-position: center;">
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
                                    <table class="table table-hover mb-0 cart-table-responsive">
                                        <thead class="table-light d-none d-md-table-header-group">
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
                                                    $product = $cartItem['product'];
                                                    $quantity = $cartItem['quantity'];
                                                    $subtotal = $cartItem['subtotal'];
                                                    $total += $subtotal;
                                                @endphp
                                                <tr class="cart-item-row">
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
                                                                    </small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="align-middle text-md-center">
                                                        <span class="mobile-label d-md-none">Harga:</span>
                                                        <span class="fw-bold text-danger">Rp {{ number_format($product->harga, 0, ',', '.') }}</span>
                                                    </td>
                                                    <td class="align-middle text-md-center">
                                                        <span class="mobile-label d-md-none">Kuantitas:</span>
                                                        <div class="d-flex align-items-center justify-content-md-center mt-2 mt-md-0">
                                                            <button type="button" 
                                                                    class="btn btn-sm btn-outline-danger rounded-circle qty-btn"
                                                                    data-id="{{ $product->id }}"
                                                                    data-action="decrease"
                                                                    {{ $quantity <= 1 ? 'disabled' : '' }}
                                                                    style="width: 30px; height: 30px">
                                                                <i class="fas fa-minus"></i>
                                                            </button>
                                                            <input type="number" 
                                                                   name="quantity" 
                                                                   value="{{ $quantity }}" 
                                                                   min="1" 
                                                                   max="{{ $product->stok }}"
                                                                   class="form-control form-control-sm mx-2 text-center qty-input" 
                                                                   data-id="{{ $product->id }}"
                                                                   style="width: 60px">
                                                            <button type="button" 
                                                                    class="btn btn-sm btn-outline-danger rounded-circle qty-btn"
                                                                    data-id="{{ $product->id }}"
                                                                    data-action="increase"
                                                                    {{ $quantity >= $product->stok ? 'disabled' : '' }}
                                                                    style="width: 30px; height: 30px">
                                                                <i class="fas fa-plus"></i>
                                                            </button>
                                                        </div>
                                                    </td>
                                                    <td class="align-middle text-md-center">
                                                        <span class="mobile-label d-md-none">Subtotal:</span>
                                                        <span class="fw-bold text-danger item-subtotal" id="subtotal-{{ $product->id }}">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                                                    </td>
                                                    <td class="align-middle text-md-center">
                                                        <div class="d-flex justify-content-start justify-content-md-center mt-2 mt-md-0">
                                                            <form action="{{ route('cart.remove', ['id' => $product->id]) }}" method="POST" class="d-flex">
                                                                @csrf
                                                                @method('DELETE')
                                                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                                <button type="submit" 
                                                                        class="btn btn-sm btn-outline-danger"
                                                                        onclick="return confirm('Hapus produk dari keranjang?')">
                                                                    <i class="fas fa-trash me-2 d-md-none"></i><span class="d-md-none">Hapus</span>
                                                                    <i class="fas fa-trash d-none d-md-inline"></i>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </td>
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
                    <div class="card border-0 shadow-sm sticky-top" style="top: 90px;">
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
                                    <span class="fw-bold" id="cart-subtotal">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
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
                                    <h4 class="fw-bold text-danger mb-0" id="cart-total">Rp {{ number_format($subtotal + 2000, 0, ',', '.') }}</h4>
                                </div>
                            </div>

                            <!-- Checkout Button -->
                            @php
                                $waNumber = config('services.whatsapp.number'); // Nomor dari config
                                $message = "Halo Pangsit Chili Oil! Saya ingin memesan:\n\n";
                                foreach($cartItems as $item) {
                                    $message .= "- " . $item['product']->nama_produk . " (x" . $item['quantity'] . ") = Rp " . number_format($item['subtotal'], 0, ',', '.') . "\n";
                                }
                                $message .= "\nSubtotal: Rp " . number_format($subtotal, 0, ',', '.') . "\n";
                                $message .= "Biaya Layanan: Rp 2.000\n";
                                $message .= "Total: Rp " . number_format($subtotal + 2000, 0, ',', '.') . "\n";

                                if (auth()->check() && auth()->user()->pelanggan) {
                                    $p = auth()->user()->pelanggan;
                                    $message .= "\n--- Detail Pemesan ---\n";
                                    $message .= "Nama: " . $p->nama_pelanggan . "\n";
                                    $message .= "HP: " . ($p->nomor_telepon ?? '-') . "\n";
                                    $message .= "Alamat: " . ($p->alamat ?? '-') . "\n";
                                }

                                $message .= "\nMohon segera diproses ya, terima kasih!";
                                
                                $waUrl = "https://wa.me/" . $waNumber . "?text=" . urlencode($message);
                            @endphp
                            
                            <form action="{{ route('cart.checkout') }}" method="POST" id="checkout-form">
                                @csrf
                                <button type="submit" id="btn-whatsapp" class="btn btn-success btn-lg w-100 py-3 mb-3">
                                    <i class="fab fa-whatsapp me-2"></i>Pesan via WhatsApp
                                </button>
                                <input type="hidden" id="wa-url" value="{{ $waUrl }}">
                            </form>

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
        // Global cart-button handler is now in cart-script.blade.php
        
        // Per-item lock to prevent multiple concurrent requests for the same product
        let itemLocks = {};

        function updateQuantity(id, newVal) {
            // Check if this specific item is already being updated
            if (itemLocks[id]) return;
            itemLocks[id] = true;

            let input = $(`.qty-input[data-id="${id}"]`);
            let currentVal = parseInt(input.val());
            
            // NO Optimistic Update: Wait for server
            $(`#subtotal-${id}`).css('opacity', '0.5');
            
            // Disable buttons and input for this item
            $(`.qty-btn[data-id="${id}"]`).attr('disabled', true);
            input.attr('disabled', true);

            $.ajax({
                url: `/cart/update/${id}`,
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    _method: 'PUT',
                    quantity: newVal
                },
                success: function(response) {
                    if (response.success) {
                        // Update UI with server-confirmed values
                        input.val(response.new_quantity);
                        $(`#subtotal-${id}`).text(response.item_subtotal);
                        $('#cart-subtotal').text(response.cart_subtotal);
                        $('#cart-total').text(response.cart_total);
                        $('#btn-whatsapp').attr('href', response.wa_url);
                        
                        const cartCount = $('#cart-count');
                        cartCount.text(response.cart_count);
                        if (response.cart_count == 0) {
                            cartCount.addClass('d-none');
                        } else {
                            cartCount.removeClass('d-none');
                        }
                    }
                },
                error: function(xhr) {
                    // Revert UI if needed (though we haven't changed input.val yet)
                    input.val(currentVal);
                    alert(xhr.responseJSON?.message || 'Gagal memperbarui jumlah');
                },
                complete: function() {
                    // Minor delay before releasing lock to prevent rapid queue triggering
                    setTimeout(() => {
                        delete itemLocks[id];
                        $(`#subtotal-${id}`).css('opacity', '1');
                        
                        // Refresh button states based on final value
                        let finalVal = parseInt(input.val());
                        let max = parseInt(input.attr('max'));
                        $(`.qty-btn[data-id="${id}"][data-action="decrease"]`).attr('disabled', finalVal <= 1);
                        $(`.qty-btn[data-id="${id}"][data-action="increase"]`).attr('disabled', finalVal >= max);
                        input.removeAttr('disabled');
                    }, 100);
                }
            });
        }

        // Handle button clicks
        $(document).on('click', '.qty-btn', function(e) {
            e.preventDefault();
            let id = $(this).data('id');
            if (itemLocks[id]) return;

            let action = $(this).data('action');
            let input = $(`.qty-input[data-id="${id}"]`);
            let currentVal = parseInt(input.val());
            let newVal = (action === 'increase') ? currentVal + 1 : Math.max(1, currentVal - 1);
            let max = parseInt(input.attr('max'));

            if (newVal > max) newVal = max;
            if (newVal === currentVal) return;

            updateQuantity(id, newVal);
        });

        // Handle direct input changes (with debounce)
        let inputTimeout;
        $(document).on('change', '.qty-input', function() {
            let id = $(this).data('id');
            let val = parseInt($(this).val());
            let max = parseInt($(this).attr('max'));

            if (isNaN(val) || val < 1) val = 1;
            if (val > max) val = max;

            updateQuantity(id, val);
        });
        // Handle WhatsApp Checkout
        $('#btn-whatsapp').on('click', function(e) {
            e.preventDefault();
            
            let waUrl = $('#wa-url').val();
            
            // 1. Open WhatsApp in new tab
            window.open(waUrl, '_blank');
            
            // 2. Submit form to clear cart & redirect
            $('#checkout-form').submit();
        });
    });
</script>
@endpush
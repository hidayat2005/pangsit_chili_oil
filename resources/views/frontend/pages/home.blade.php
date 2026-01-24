@extends('frontend.layouts.front')

@section('title', 'Pangsit Chili Oil - Home')

@section('content')
    <!-- HERO SECTION -->
    <section class="hero-section" style="background: linear-gradient(rgba(74, 44, 42, 0.8), rgba(178, 34, 34, 0.7)), url('{{ asset('images/background.jpg') }}'); background-size: cover; background-position: center;">
        <div class="container">
            <div class="row align-items-center min-vh-80">
                <div class="col-lg-6 text-white" data-aos="fade-right">
                    <h1 class="display-4 fw-bold mb-4">Pangsit Crispy dengan <span class="text-warning">Chili Oil Autentik</span></h1>
                    <p class="lead mb-4">Rasa yang menggugah selera, dibuat dengan bahan-bahan pilihan dan resep turun temurun.</p>
                    <div class="d-flex flex-wrap gap-3">
                        <a href="{{ route('front.products') }}" class="btn btn-warning btn-lg px-4 py-3 fw-bold">
                            <i class="fas fa-shopping-bag me-2"></i>Pesan Sekarang
                        </a>
                        <a href="#produk" class="btn btn-outline-light btn-lg px-4 py-3">
                            <i class="fas fa-utensils me-2"></i>Lihat Menu
                        </a>
                    </div>
                    
                    <!-- Stats -->
                    <div class="row mt-5 pt-4">
                        <div class="col-4 text-center">
                            <div class="border border-warning border-2 rounded-circle d-inline-flex align-items-center justify-content-center mb-2" style="width: 70px; height: 70px;">
                                <h3 class="fw-bold text-warning mb-0">4.9</h3>
                            </div>
                            <div class="text-warning mb-1">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                            <small class="text-white-50">Rating</small>
                        </div>
                        <div class="col-4 text-center">
                            <div class="border border-warning border-2 rounded-circle d-inline-flex align-items-center justify-content-center mb-2" style="width: 70px; height: 70px;">
                                <h3 class="fw-bold text-warning mb-0">500+</h3>
                            </div>
                            <p class="text-white-50 mb-0">Pelanggan</p>
                        </div>
                        <div class="col-4 text-center">
                            <div class="border border-warning border-2 rounded-circle d-inline-flex align-items-center justify-content-center mb-2" style="width: 70px; height: 70px;">
                                <h3 class="fw-bold text-warning mb-0">50+</h3>
                            </div>
                            <p class="text-white-50 mb-0">Variasi</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mt-4 mt-lg-0" data-aos="fade-left" data-aos-delay="200">
                    <div class="position-relative">
                        <div class="rounded-circle bg-warning mx-auto hero-image-circle" 
                             style="position: relative; overflow: hidden; border: 10px solid rgba(255,255,255,0.2);">
                            <img src="/images/background_dua.jpg" 
                                 alt="Pangsit Chili Oil" 
                                 class="img-fluid rounded-circle w-100 h-100 object-fit-cover"
                                 loading="lazy">
                        </div>
                    </div>
                </div>

                <style>
                    .hero-image-circle {
                        width: 450px; height: 450px;
                    }
                    @media (max-width: 991px) {
                        .hero-image-circle {
                            width: 300px; height: 300px;
                        }
                    }
                    @media (max-width: 576px) {
                        .hero-image-circle {
                            width: 250px; height: 250px;
                        }
                    }
                </style>
            </div>
        </div>
    </section>

    <!-- FEATURED PRODUCTS -->
    <section id="produk" class="py-5 bg-light">
        <div class="container">
            <div class="row mb-5" data-aos="fade-up">
                <div class="col-12 text-center">
                    <span class="badge bg-danger rounded-pill px-3 py-2 mb-3">Menu Unggulan</span>
                    <h2 class="fw-bold mb-3 text-danger">Produk Terlaris</h2>
                    <p class="text-muted">Pilihan terbaik dari dapur kami</p>
                </div>
            </div>
            
            <!-- Swiper Container -->
            <div class="swiper featured-swiper pb-5">
                <div class="swiper-wrapper">
                    @php
                        $featuredProducts = \App\Models\Produk::where('status', 'tersedia')
                            ->orderBy('created_at', 'desc')
                            ->take(8)
                            ->get();
                    @endphp
                    
                    @foreach($featuredProducts as $product)
                    <div class="swiper-slide h-auto px-2">
                        @include('frontend.partials.product-card', ['product' => $product, 'noWrapper' => true])
                    </div>
                    @endforeach
                </div>
                <!-- Pagination -->
                <div class="swiper-pagination"></div>
                <!-- Navigation -->
                <div class="swiper-button-next text-danger"></div>
                <div class="swiper-button-prev text-danger"></div>
            </div>
                
                @if($featuredProducts->isEmpty())
                <div class="col-12 text-center py-5">
                    <div class="py-4">
                        <i class="fas fa-box-open fa-4x text-danger mb-4"></i>
                        <h4 class="text-danger mb-3">Belum ada produk</h4>
                        <p class="text-muted mb-4">Produk sedang dalam persiapan</p>
                    </div>
                </div>
                @endif
            </div>
            
            <!-- View All Button -->
            @if($featuredProducts->isNotEmpty())
            <div class="text-center mt-5">
                <a href="{{ route('front.products') }}" class="btn btn-outline-danger btn-lg px-5 py-3">
                    Lihat Semua Produk <i class="fas fa-arrow-right ms-2"></i>
                </a>
            </div>
            @endif
        </div>
    </section>

    <!-- WHY CHOOSE US -->
    <section class="py-5 bg-white">
        <div class="container">
            <div class="row mb-5" data-aos="fade-up">
                <div class="col-12 text-center">
                    <span class="badge bg-danger rounded-pill px-3 py-2 mb-3">Keunggulan</span>
                    <h2 class="fw-bold mb-3 text-danger">Mengapa Memilih Kami?</h2>
                    <p class="text-muted">Kualitas yang membuat kami berbeda</p>
                </div>
            </div>
            
            <div class="row g-4">
                <div class="col-lg-3 col-md-6" data-aos="zoom-in" data-aos-delay="100">
                    <div class="card border-0 shadow-sm h-100 text-center p-4">
                        <div class="icon-wrapper mb-3">
                            <div class="rounded-circle bg-danger bg-opacity-10 d-inline-flex align-items-center justify-content-center" 
                                 style="width: 80px; height: 80px;">
                                <i class="fas fa-leaf fa-2x text-danger"></i>
                            </div>
                        </div>
                        <h5 class="fw-bold mb-3">Bahan Premium</h5>
                        <p class="text-muted">Dibuat dengan bahan-bahan pilihan berkualitas tinggi dan segar setiap hari.</p>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6" data-aos="zoom-in" data-aos-delay="200">
                    <div class="card border-0 shadow-sm h-100 text-center p-4">
                        <div class="icon-wrapper mb-3">
                            <div class="rounded-circle bg-danger bg-opacity-10 d-inline-flex align-items-center justify-content-center" 
                                 style="width: 80px; height: 80px;">
                                <i class="fas fa-clock fa-2x text-danger"></i>
                            </div>
                        </div>
                        <h5 class="fw-bold mb-3">Fresh Cooked</h5>
                        <p class="text-muted">Dimasak setelah pesanan masuk untuk memastikan kesegaran maksimal.</p>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6" data-aos="zoom-in" data-aos-delay="300">
                    <div class="card border-0 shadow-sm h-100 text-center p-4">
                        <div class="icon-wrapper mb-3">
                            <div class="rounded-circle bg-danger bg-opacity-10 d-inline-flex align-items-center justify-content-center" 
                                 style="width: 80px; height: 80px;">
                                <i class="fas fa-shipping-fast fa-2x text-danger"></i>
                            </div>
                        </div>
                        <h5 class="fw-bold mb-3">Pengiriman Cepat</h5>
                        <p class="text-muted">Diantar langsung ke lokasi Anda dengan sistem pengiriman yang efisien.</p>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6" data-aos="zoom-in" data-aos-delay="400">
                    <div class="card border-0 shadow-sm h-100 text-center p-4">
                        <div class="icon-wrapper mb-3">
                            <div class="rounded-circle bg-danger bg-opacity-10 d-inline-flex align-items-center justify-content-center" 
                                 style="width: 80px; height: 80px;">
                                <i class="fas fa-medal fa-2x text-danger"></i>
                            </div>
                        </div>
                        <h5 class="fw-bold mb-3">Resep Autentik</h5>
                        <p class="text-muted">Resep turun temurun dengan cita rasa yang otentik dan khas.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- TESTIMONIALS -->
    <section class="py-5 bg-light-pattern">
        <div class="container">
            <div class="row mb-5" data-aos="fade-up">
                <div class="col-12 text-center">
                    <span class="badge bg-danger rounded-pill px-3 py-2 mb-3">Testimoni</span>
                    <h2 class="fw-bold mb-3 text-danger">Apa Kata Pelanggan</h2>
                    <p class="text-muted">Testimoni dari mereka yang sudah mencoba</p>
                </div>
            </div>
            
            <div class="row g-4">
                <!-- Testimonial 1 -->
                <div class="col-lg-4 col-md-6">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center mb-4">
                                <div class="flex-shrink-0">
                                    <img src="https://randomuser.me/api/portraits/women/32.jpg" 
                                         class="rounded-circle border border-3 border-danger" 
                                         width="60" 
                                         height="60" 
                                         alt="Customer">
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="fw-bold mb-1">Rina Wijaya</h6>
                                    <div class="text-warning small">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="card-text">"Pangsitnya crispy banget, chili oilnya bikin nagih! Sudah pesen berkali-kali buat keluarga."</p>
                            <small class="text-muted">2 hari yang lalu</small>
                        </div>
                    </div>
                </div>
                
                <!-- Testimonial 2 -->
                <div class="col-lg-4 col-md-6">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center mb-4">
                                <div class="flex-shrink-0">
                                    <img src="https://randomuser.me/api/portraits/men/54.jpg" 
                                         class="rounded-circle border border-3 border-danger" 
                                         width="60" 
                                         height="60" 
                                         alt="Customer">
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="fw-bold mb-1">Budi Santoso</h6>
                                    <div class="text-warning small">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half-alt"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="card-text">"Rasanya autentik banget, persis kayak yang dijual di restoran ternama."</p>
                            <small class="text-muted">1 minggu yang lalu</small>
                        </div>
                    </div>
                </div>
                
                <!-- Testimonial 3 -->
                <div class="col-lg-4 col-md-6">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center mb-4">
                                <div class="flex-shrink-0">
                                    <img src="https://randomuser.me/api/portraits/women/67.jpg" 
                                         class="rounded-circle border border-3 border-danger" 
                                         width="60" 
                                         height="60" 
                                         alt="Customer">
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="fw-bold mb-1">Sari Dewi</h6>
                                    <div class="text-warning small">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="card-text">"Perfect untuk acara arisan! Teman-teman semua pada suka. Recommended banget!"</p>
                            <small class="text-muted">3 hari yang lalu</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA SECTION -->
    <section class="py-5 bg-red-pattern text-white" data-aos="fade-up">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8" data-aos="fade-right" data-aos-delay="100">
                    <h3 class="fw-bold mb-3">Siap Menikmati Pangsit Chili Oil Terbaik?</h3>
                    <p class="mb-0 opacity-75">Pesan sekarang dan dapatkan pengalaman kuliner yang tak terlupakan.</p>
                </div>
                <div class="col-lg-4 text-lg-end mt-4 mt-lg-0" data-aos="fade-left" data-aos-delay="200">
                    <a href="{{ route('front.products') }}" class="btn glass-btn px-4 py-3">
                        <i class="fas fa-shopping-cart me-2"></i>Pesan Sekarang
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('styles')
<style>
    .hero-section {
        position: relative;
        overflow: hidden;
    }
    
    .min-vh-80 {
        min-height: 80vh;
    }
    
    .product-card {
        transition: all 0.3s ease;
        border-radius: 15px;
        overflow: hidden;
    }
    
    .product-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 30px rgba(220, 53, 69, 0.15);
    }
    
    .product-image-container {
        position: relative;
    }
    
    .product-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(to bottom, transparent 50%, rgba(0,0,0,0.7));
        opacity: 0;
        transition: opacity 0.3s;
    }
    
    .product-card:hover .product-overlay {
        opacity: 1;
    }
    
    .object-fit-cover {
        object-fit: cover;
    }
    
    .icon-wrapper {
        transition: transform 0.3s;
    }
    
    .card:hover .icon-wrapper {
        transform: scale(1.1);
    }
    
    .border-danger {
        border-color: #dc3545 !important;
    }

    /* Red Pattern Background - More Diverse Icons */
    .bg-red-pattern {
        background-color: #dc3545;
        background-image: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='%23ffffff' fill-opacity='0.08'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm0 2c-4.97 0-9-4.03-9-9s4.03-9 9-9 9 4.03 9 9-4.03 9-9 9z'/%3E%3Cpath d='M15 15h2v2h-2zM10 10l2 2-2 2-2-2 2-2zM30 10h10v2H30v-2zm0 4h10v2H30v-2zm0 4h10v2H30v-2z'/%3E%3Cpath d='M50 30c5.523 0 10-4.477 10-10S55.523 10 50 10 40 14.477 40 20s4.477 10 10 10zm0 2c-6.627 0-12-5.373-12-12s5.373-12 12-12 12 5.373 12 12-5.373 12-12 12z'/%3E%3Cpath d='M48 20h4v6h-4zm0-8h4v6h-4zM70 15h10v20H70V15zm2 2h6v16h-6V17z'/%3E%3Cpath d='M85 45c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm0 1c-3.314 0-6-2.686-6-6s2.686-6 6-6 6 2.686 6 6-2.686 6-6 6z'/%3E%3Cpath d='M15 65l10-10 2 2-10 10-2-2zM15 55l10 10-2 2-10-10 2-2zM40 70h20v2H40v-2zm5-10h10v2H45v-2zm0 20h10v2H45v-2z'/%3E%3Cpath d='M75 80c5.523 0 10-4.477 10-10S80.523 60 75 60s-10 4.477-10 10 4.477 10 10 10zm0 2c-6.627 0-12-5.373-12-12s5.373-12 12-12 12 5.373 12 12-5.373 12-12 12z'/%3E%3C/g%3E%3C/svg%3E");
    }

    .bg-light-pattern {
        background-color: rgba(220, 53, 69, 0.03);
        background-image: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='%23dc3545' fill-opacity='0.05'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm0 2c-4.97 0-9-4.03-9-9s4.03-9 9-9 9 4.03 9 9-4.03 9-9 9z'/%3E%3Cpath d='M15 15h2v2h-2zM10 10l2 2-2 2-2-2 2-2zM30 10h10v2H30v-2zm0 4h10v2H30v-2zm0 4h10v2H30v-2z'/%3E%3Cpath d='M50 30c5.523 0 10-4.477 10-10S55.523 10 50 10 40 14.477 40 20s4.477 10 10 10zm0 2c-6.627 0-12-5.373-12-12s5.373-12 12-12 12 5.373 12 12-5.373 12-12 12z'/%3E%3Cpath d='M48 20h4v6h-4zm0-8h4v6h-4zM70 15h10v20H70V15zm2 2h6v16h-6V17z'/%3E%3Cpath d='M85 45c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm0 1c-3.314 0-6-2.686-6-6s2.686-6 6-6 6 2.686 6 6-2.686 6-6 6z'/%3E%3Cpath d='M15 65l10-10 2 2-10 10-2-2zM15 55l10 10-2 2-10-10 2-2zM40 70h20v2H40v-2zm5-10h10v2H45v-2zm0 20h10v2H45v-2z'/%3E%3Cpath d='M75 80c5.523 0 10-4.477 10-10S80.523 60 75 60s-10 4.477-10 10 4.477 10 10 10zm0 2c-6.627 0-12-5.373-12-12s5.373-12 12-12 12 5.373 12 12-5.373 12-12 12z'/%3E%3C/g%3E%3C/svg%3E");
    }
</style>
@endpush

@push('scripts')
<script>
    $(document).ready(function() {
        // Initialize Swiper for featured products
        const featuredSwiper = new Swiper('.featured-swiper', {
            // Basic settings
            slidesPerView: 1,
            spaceBetween: 20,
            loop: true,
            autoplay: {
                delay: 2000, // Faster (2 seconds)
                disableOnInteraction: false,
                pauseOnMouseEnter: true
            },
            
            // Pagination
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
                dynamicBullets: true
            },
            
            // Navigation Arrows
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            
            // Responsive Breakpoints
            breakpoints: {
                576: {
                    slidesPerView: 2,
                },
                992: {
                    slidesPerView: 3, // 3 cards as requested
                }
            }
        });
    });
</script>
@endpush
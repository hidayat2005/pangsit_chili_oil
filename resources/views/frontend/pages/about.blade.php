@extends('frontend.layouts.front')

@section('title', 'Tentang Kami - Pangsit Chili Oil')

@section('content')
    <!-- HERO BANNER -->
    <section class="hero-section" style="background: linear-gradient(rgba(74, 44, 42, 0.9), rgba(178, 34, 34, 0.9)), url('{{ asset('images/Image Halaman Tentang.webp') }}'); background-size: cover; background-position: center;">
        <div class="container">
            <div class="row min-vh-50 align-items-center">
                <div class="col-lg-8 mx-auto text-center text-white">
                    <h1 class="display-4 fw-bold mb-4">Tentang <span class="text-warning">Pangsit Chili Oil</span></h1>
                    <p class="lead mb-4">Cerita di balik cita rasa autentik yang telah dinikmati oleh ribuan pelanggan.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- OUR STORY -->
    <section class="py-5 bg-white">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <span class="badge bg-danger rounded-pill px-3 py-2 mb-3">Cerita Kami</span>
                    <h2 class="fw-bold text-danger mb-4">Dari Dapur Kecil ke Meja Anda</h2>
                    <p class="text-muted mb-4">
                        Pangsit Chili Oil lahir dari kecintaan terhadap kuliner autentik dan keinginan untuk membagikan cita rasa 
                        yang tak terlupakan. Berawal dari resep turun temurun keluarga, kami mengembangkan pangsit crispy dengan 
                        chili oil spesial yang kini telah menjadi favorit banyak orang.
                    </p>
                    <p class="text-muted mb-4">
                        Setiap pangsit dibuat dengan penuh cinta dan perhatian terhadap detail. Kami hanya menggunakan bahan-bahan 
                        pilihan berkualitas tinggi untuk memastikan setiap gigitan memberikan pengalaman kuliner terbaik.
                    </p>
                    <a href="{{ route('front.products') }}" class="btn glass-btn-danger px-4">
                        <i class="fas fa-shopping-bag me-2"></i>Lihat Produk
                    </a>
                </div>
                <div class="col-lg-6">
                    <div class="position-relative">
                        <div class="rounded-4 overflow-hidden shadow-lg">
                            <img src="{{ asset('images/All Pangsit Chili Oil .webp') }}" 
                                alt="Pangsit Chili Oil" 
                                class="img-fluid w-100"
                                style="height: 400px; object-fit: cover;">
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- OUR VALUES -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row mb-5">
                <div class="col-12 text-center">
                    <span class="badge bg-danger rounded-pill px-3 py-2 mb-3">Nilai Kami</span>
                    <h2 class="fw-bold mb-3 text-danger">Yang Membuat Kami Berbeda</h2>
                    <p class="text-muted">Komitmen terhadap kualitas dan kepuasan pelanggan</p>
                </div>
            </div>
            
            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <div class="card glass-card h-100 p-4">
                        <div class="icon-wrapper mb-3">
                            <div class="rounded-circle bg-danger bg-opacity-10 d-inline-flex align-items-center justify-content-center" 
                                 style="width: 80px; height: 80px;">
                                <i class="fas fa-award fa-2x text-danger"></i>
                            </div>
                        </div>
                        <h5 class="fw-bold mb-3">Kualitas Terbaik</h5>
                        <p class="text-muted">Hanya bahan terpilih yang kami gunakan, dengan proses pembuatan yang higienis dan terstandarisasi.</p>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <div class="card glass-card h-100 p-4">
                        <div class="icon-wrapper mb-3">
                            <div class="rounded-circle bg-danger bg-opacity-10 d-inline-flex align-items-center justify-content-center" 
                                 style="width: 80px; height: 80px;">
                                <i class="fas fa-clock fa-2x text-danger"></i>
                            </div>
                        </div>
                        <h5 class="fw-bold mb-3">Kesegaran Terjaga</h5>
                        <p class="text-muted">Diproduksi per pesanan untuk memastikan kesegaran maksimal saat sampai ke tangan Anda.</p>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <div class="card glass-card h-100 p-4">
                        <div class="icon-wrapper mb-3">
                            <div class="rounded-circle bg-danger bg-opacity-10 d-inline-flex align-items-center justify-content-center" 
                                 style="width: 80px; height: 80px;">
                                <i class="fas fa-heart fa-2x text-danger"></i>
                            </div>
                        </div>
                        <h5 class="fw-bold mb-3">Dibuat dengan Cinta</h5>
                        <p class="text-muted">Setiap pangsit dibuat dengan sepenuh hati, mengutamakan cita rasa dan kepuasan pelanggan.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA SECTION -->
    <section class="py-4 bg-danger text-white position-relative overflow-hidden">
        <div class="container position-relative" style="z-index: 2;">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <h3 class="fw-bold mb-3">Siap Menjadi Bagian dari Cerita Kami?</h3>
                    <p class="mb-0 opacity-75">Bergabunglah dengan ribuan pelanggan puas yang telah menikmati kelezatan Pangsit Chili Oil.</p>
                </div>
                <div class="col-lg-4 text-lg-end mt-4 mt-lg-0">
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
    .min-vh-60 {
        min-height: 60vh;
    }
    
    .icon-wrapper {
        transition: transform 0.3s;
    }
    
    .card:hover .icon-wrapper {
        transform: scale(1.1);
    }
</style>
@endpush
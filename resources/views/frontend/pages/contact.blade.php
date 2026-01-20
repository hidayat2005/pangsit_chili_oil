@extends('frontend.layouts.front')

@section('title', 'Kontak - Pangsit Chili Oil')

@section('content')
    <!-- HERO BANNER -->
    <section class="hero-section" style="background: linear-gradient(rgba(74, 44, 42, 0.9), rgba(178, 34, 34, 0.9)), url('https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?ixlib=rb-4.0.3&auto=format&fit=crop&w=2080&q=80'); background-size: cover; background-position: center;">
        <div class="container">
            <div class="row min-vh-50 align-items-center">
                <div class="col-lg-8 mx-auto text-center text-white">
                    <h1 class="display-4 fw-bold mb-4">Hubungi <span class="text-warning">Kami</span></h1>
                    <p class="lead mb-4">Kami siap membantu dan menjawab pertanyaan Anda tentang produk dan layanan kami.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CONTACT INFO -->
    <section class="py-5 bg-white">
        <div class="container">
            <div class="row mb-5">
                <div class="col-12 text-center">
                    <span class="badge bg-danger rounded-pill px-3 py-2 mb-3">Informasi Kontak</span>
                    <h2 class="fw-bold mb-3 text-danger">Kami Siap Membantu Anda</h2>
                    <p class="text-muted">Jangan ragu untuk menghubungi kami melalui berbagai saluran yang tersedia</p>
                </div>
            </div>
            
            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <div class="card border-0 shadow-sm h-100 text-center p-4 contact-card">
                        <div class="icon-wrapper mb-3">
                            <div class="rounded-circle bg-danger bg-opacity-10 d-inline-flex align-items-center justify-content-center" 
                                 style="width: 80px; height: 80px;">
                                <i class="fas fa-map-marker-alt fa-2x text-danger"></i>
                            </div>
                        </div>
                        <h5 class="fw-bold mb-3">Lokasi Kami</h5>
                        <p class="text-muted mb-0">
                            Jl. Raya Contoh No. 123<br>
                            Jakarta Selatan<br>
                            DKI Jakarta 12560
                        </p>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <div class="card border-0 shadow-sm h-100 text-center p-4 contact-card">
                        <div class="icon-wrapper mb-3">
                            <div class="rounded-circle bg-danger bg-opacity-10 d-inline-flex align-items-center justify-content-center" 
                                 style="width: 80px; height: 80px;">
                                <i class="fas fa-phone fa-2x text-danger"></i>
                            </div>
                        </div>
                        <h5 class="fw-bold mb-3">Telepon & WhatsApp</h5>
                        <p class="text-muted mb-2">
                            <a href="tel:+6281234567890" class="text-decoration-none text-dark">
                                <i class="fas fa-phone me-2 text-danger"></i>+62 812-3456-7890
                            </a>
                        </p>
                        <p class="text-muted mb-0">
                            <a href="https://wa.me/6281234567890" class="text-decoration-none text-dark" target="_blank">
                                <i class="fab fa-whatsapp me-2 text-success"></i>+62 812-3456-7890
                            </a>
                        </p>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <div class="card border-0 shadow-sm h-100 text-center p-4 contact-card">
                        <div class="icon-wrapper mb-3">
                            <div class="rounded-circle bg-danger bg-opacity-10 d-inline-flex align-items-center justify-content-center" 
                                 style="width: 80px; height: 80px;">
                                <i class="fas fa-envelope fa-2x text-danger"></i>
                            </div>
                        </div>
                        <h5 class="fw-bold mb-3">Email & Sosial Media</h5>
                        <p class="text-muted mb-2">
                            <a href="mailto:order@pangsitchilioil.com" class="text-decoration-none text-dark">
                                <i class="fas fa-envelope me-2 text-danger"></i>order@pangsitchilioil.com
                            </a>
                        </p>
                        <div class="social-icons mt-3">
                            <a href="#" class="btn btn-danger btn-sm rounded-circle me-2">
                                <i class="fab fa-instagram"></i>
                            </a>
                            <a href="#" class="btn btn-danger btn-sm rounded-circle me-2">
                                <i class="fab fa-facebook"></i>
                            </a>
                            <a href="#" class="btn btn-danger btn-sm rounded-circle">
                                <i class="fab fa-tiktok"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CONTACT FORM & MAP -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row g-5">
                <!-- Contact Form -->
                <div class="col-lg-6">
                    <div class="card border-0 shadow-sm p-4">
                        <h3 class="fw-bold text-danger mb-4">Kirim Pesan kepada Kami</h3>
                        
                        @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show mb-4">
                            <i class="fas fa-check-circle me-2"></i>
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                        @endif
                        
                        <form action="{{ route('contact.submit') }}" method="POST">
                            @csrf
                            
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" 
                                               class="form-control @error('name') is-invalid @enderror" 
                                               id="name" 
                                               name="name"
                                               placeholder="Nama Lengkap"
                                               value="{{ old('name') }}">
                                        <label for="name">
                                            <i class="fas fa-user me-2 text-danger"></i>Nama Lengkap
                                        </label>
                                        @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="email" 
                                               class="form-control @error('email') is-invalid @enderror" 
                                               id="email" 
                                               name="email"
                                               placeholder="Email"
                                               value="{{ old('email') }}">
                                        <label for="email">
                                            <i class="fas fa-envelope me-2 text-danger"></i>Email
                                        </label>
                                        @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-12">
                                    <div class="form-floating">
                                        <input type="text" 
                                               class="form-control @error('subject') is-invalid @enderror" 
                                               id="subject" 
                                               name="subject"
                                               placeholder="Subjek"
                                               value="{{ old('subject') }}">
                                        <label for="subject">
                                            <i class="fas fa-tag me-2 text-danger"></i>Subjek
                                        </label>
                                        @error('subject')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-12">
                                    <div class="form-floating">
                                        <textarea class="form-control @error('message') is-invalid @enderror" 
                                                  id="message" 
                                                  name="message"
                                                  placeholder="Pesan"
                                                  style="height: 150px">{{ old('message') }}</textarea>
                                        <label for="message">
                                            <i class="fas fa-comment me-2 text-danger"></i>Pesan Anda
                                        </label>
                                        @error('message')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-12">
                                    <button type="submit" class="btn btn-danger btn-lg w-100 py-3">
                                        <i class="fas fa-paper-plane me-2"></i>Kirim Pesan
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                
                <!-- Map & Hours -->
                <div class="col-lg-6">
                    <!-- Map -->
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body p-0">
                            <div class="ratio ratio-16x9">
                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.521260322283!2d106.8195613506864!3d-6.194741395493371!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f5390917b759%3A0x6b45e67356080477!2sJakarta%2C%20Indonesia!5e0!3m2!1sen!2sus!4v1603878288333!5m2!1sen!2sus" 
                                        style="border:0;" 
                                        allowfullscreen="" 
                                        aria-hidden="false" 
                                        tabindex="0"></iframe>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Business Hours -->
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-4">
                            <h4 class="fw-bold text-danger mb-4">
                                <i class="fas fa-clock me-2"></i>Jam Operasional
                            </h4>
                            
                            <div class="table-responsive">
                                <table class="table table-borderless">
                                    <tbody>
                                        <tr>
                                            <td class="text-muted">Senin - Jumat</td>
                                            <td class="text-end fw-bold">09:00 - 21:00 WIB</td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">Sabtu</td>
                                            <td class="text-end fw-bold">09:00 - 22:00 WIB</td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">Minggu</td>
                                            <td class="text-end fw-bold">10:00 - 20:00 WIB</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('styles')
<style>
    .min-vh-50 {
        min-height: 50vh;
    }
    
    .contact-card {
        transition: all 0.3s ease;
        border-radius: 15px;
        overflow: hidden;
    }
    
    .contact-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(220, 53, 69, 0.1);
    }
    
    .contact-card:hover .icon-wrapper {
        transform: scale(1.1);
    }
    
    .icon-wrapper {
        transition: transform 0.3s;
    }
    
    .form-floating > .form-control,
    .form-floating > .form-control-plaintext {
        border-left: 3px solid #dc3545;
    }
    
    .form-floating > .form-control:focus,
    .form-floating > .form-control-plaintext:focus {
        border-color: #dc3545;
        box-shadow: 0 0 0 0.25rem rgba(220, 53, 69, 0.25);
    }
</style>
@endpush
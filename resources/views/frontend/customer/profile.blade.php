@extends('frontend.layouts.front')

@section('title', 'Profil Saya - Pangsit Chili Oil')

@section('content')
<div class="container py-5" style="min-height: 70vh;">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="d-flex align-items-center mb-4">
                <h2 class="fw-bold mb-0">Profil <span class="text-danger">Saya</span></h2>
            </div>

            <div class="card glass-card border-0 p-4 mb-4">
                <div class="row align-items-center">
                    <div class="col-md-3 text-center mb-3 mb-md-0">
                        <div class="rounded-circle bg-danger bg-opacity-10 d-inline-flex align-items-center justify-content-center" 
                             style="width: 120px; height: 120px;">
                            <i class="fas fa-user fa-4x text-danger font-weight-light"></i>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <h3 class="fw-bold text-dark mb-1">{{ $pelanggan->nama_pelanggan }}</h3>
                        <p class="text-muted mb-3"><i class="fas fa-envelope me-2"></i>{{ $pelanggan->email }}</p>
                        
                        <div class="d-flex flex-wrap gap-2">
                            <a href="{{ route('customer.profile.edit') }}" class="btn btn-danger rounded-pill px-4">
                                <i class="fas fa-edit me-2"></i>Edit Profil
                            </a>
                            <a href="{{ route('customer.orders') }}" class="btn glass-btn-dark rounded-pill px-4">
                                <i class="fas fa-shopping-bag me-2"></i>Pesanan Saya
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-4">
                <div class="col-md-6">
                    <div class="card glass-card border-0 p-4 h-100">
                        <h5 class="fw-bold text-danger mb-3">
                            <i class="fas fa-phone-alt me-2"></i>Informasi Kontak
                        </h5>
                        <p class="mb-1 text-muted small">Nomor Telepon</p>
                        <p class="fw-bold mb-0 text-dark">
                            {{ $pelanggan->nomor_telepon ? $pelanggan->nomor_telepon : 'Belum diatur' }}
                        </p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card glass-card border-0 p-4 h-100">
                        <h5 class="fw-bold text-danger mb-3">
                            <i class="fas fa-map-marker-alt me-2"></i>Alamat Pengiriman
                        </h5>
                        <p class="mb-1 text-muted small">Alamat Lengkap</p>
                        <p class="fw-bold mb-0 text-dark">
                            {{ $pelanggan->alamat ? $pelanggan->alamat : 'Belum diatur' }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.admin')

@section('title', 'Dashboard Overview')

@section('content')
<div class="container-fluid p-0">
    <!-- Welcome Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="glass-card p-4 d-flex align-items-center justify-content-between flex-wrap gap-3">
                <div>
                    <h2 class="fw-bold mb-1">Selamat Datang, {{ Auth::user()->name ?? 'Admin' }}! 👋</h2>
                    <p class="text-muted mb-0">Berikut adalah ringkasan performa toko Anda hari ini.</p>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('admin.produk.index') }}" class="btn btn-primary">
                        <i class="fas fa-plus me-2"></i> Tambah Produk
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row g-4 mb-4">
        <!-- Total Produk -->
        <div class="col-xl-3 col-md-6">
            <div class="card h-100 overflow-hidden" style="border-left: 5px solid var(--primary-red) !important;">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="rounded-circle d-flex align-items-center justify-content-center" 
                             style="width: 50px; height: 50px; background: rgba(220, 53, 69, 0.1); color: var(--primary-red);">
                            <i class="fas fa-box fs-4"></i>
                        </div>
                    </div>
                    <div>
                        <h6 class="text-muted fw-bold text-uppercase mb-1" style="font-size: 0.75rem; letter-spacing: 0.05em;">Total Produk</h6>
                        <h2 class="fw-bold mb-0 text-dark">{{ $totalProduk }}</h2>
                    </div>
                </div>
                <div class="card-footer bg-transparent border-0 px-4 pb-4">
                   <a href="{{ route('admin.produk.index') }}" class="text-primary text-decoration-none fw-bold" style="font-size: 0.85rem;">
                       Lihat Detail <i class="fas fa-arrow-right ms-1"></i>
                   </a>
                </div>
            </div>
        </div>

        <!-- Total Kategori -->
        <div class="col-xl-3 col-md-6">
            <div class="card h-100 overflow-hidden" style="border-left: 5px solid var(--accent-orange) !important;">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="rounded-circle d-flex align-items-center justify-content-center" 
                             style="width: 50px; height: 50px; background: rgba(253, 126, 20, 0.1); color: var(--accent-orange);">
                            <i class="fas fa-layer-group fs-4"></i>
                        </div>
                    </div>
                    <div>
                        <h6 class="text-muted fw-bold text-uppercase mb-1" style="font-size: 0.75rem; letter-spacing: 0.05em;">Total Kategori</h6>
                        <h2 class="fw-bold mb-0 text-dark">{{ $totalKategori }}</h2>
                    </div>
                </div>
                <div class="card-footer bg-transparent border-0 px-4 pb-4">
                   <a href="{{ route('admin.kategori.index') }}" class="text-orange text-decoration-none fw-bold" style="font-size: 0.85rem; color: var(--accent-orange);">
                       Lihat Detail <i class="fas fa-arrow-right ms-1"></i>
                   </a>
                </div>
            </div>
        </div>

        <!-- Placeholder for future stats - e.g. Total Pelanggan if you want to add it -->
        <div class="col-xl-3 col-md-6">
            <div class="card h-100 overflow-hidden" style="border-left: 5px solid #0ea5e9 !important;">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="rounded-circle d-flex align-items-center justify-content-center" 
                             style="width: 50px; height: 50px; background: rgba(14, 165, 233, 0.1); color: #0ea5e9;">
                            <i class="fas fa-users fs-4"></i>
                        </div>
                    </div>
                    <div>
                        <h6 class="text-muted fw-bold text-uppercase mb-1" style="font-size: 0.75rem; letter-spacing: 0.05em;">Status Server</h6>
                        <h2 class="fw-bold mb-0 text-dark">Aktif</h2>
                    </div>
                </div>
                <div class="card-footer bg-transparent border-0 px-4 pb-4">
                   <span class="badge bg-success">Online</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions Row -->
    <div class="row mb-5">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3 border-bottom d-flex align-items-center justify-content-between">
                    <h5 class="fw-bold mb-0">Navigasi Cepat</h5>
                    <i class="fas fa-ellipsis-v text-muted"></i>
                </div>
                <div class="card-body p-4">
                    <div class="row g-3">
                        <div class="col-sm-6 col-lg-3">
                            <a href="{{ route('admin.produk.index') }}" class="btn w-100 h-100 p-3 btn-light border d-flex flex-column align-items-center gap-2">
                                <i class="fas fa-boxes fs-3 text-primary"></i>
                                <span class="fw-bold">Stok Produk</span>
                            </a>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <a href="{{ route('admin.kategori.index') }}" class="btn w-100 h-100 p-3 btn-light border d-flex flex-column align-items-center gap-2">
                                <i class="fas fa-tags fs-3 text-info"></i>
                                <span class="fw-bold">Ketegori</span>
                            </a>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <a href="{{ route('admin.pelanggan.index') }}" class="btn w-100 h-100 p-3 btn-light border d-flex flex-column align-items-center gap-2">
                                <i class="fas fa-user-friends fs-3 text-success"></i>
                                <span class="fw-bold">Pelanggan</span>
                            </a>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <a href="#" class="btn w-100 h-100 p-3 btn-light border d-flex flex-column align-items-center gap-2">
                                <i class="fas fa-cog fs-3 text-secondary"></i>
                                <span class="fw-bold">Setelan</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="glass-card p-4 h-100 d-flex flex-column justify-content-center text-center">
                <div class="mb-3">
                    <i class="fas fa-rocket fa-3x text-primary opacity-50"></i>
                </div>
                <h5 class="fw-bold mb-2">Pantau Terus!</h5>
                <p class="text-muted small">Kelola data Anda dengan lebih efisien menggunakan dashboard baru yang lebih cepat dan modern.</p>
                <div class="mt-auto">
                    <button class="btn btn-outline-primary btn-sm w-100">Buka Tutorial</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
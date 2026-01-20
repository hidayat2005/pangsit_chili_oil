@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
    <!-- Header -->
    <div class="row mb-4">
        <div class="col">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h3 class="mb-1">Dashboard Admin</h3>
                    <p class="text-muted mb-0">Selamat datang di sistem manajemen Pangsit Chili Oil</p>
                </div>
                <div class="d-flex align-items-center">
                    <span class="badge bg-danger me-2">Live</span>
                    <small class="text-muted">
                        <i class="fas fa-clock me-1"></i>
                        {{ now()->format('d F Y, H:i') }}
                    </small>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistik Utama -->
    <div class="row mb-4">
        <!-- Total Pelanggan -->
        <div class="col-md-3 mb-3">
            <div class="card bg-primary text-white h-100">
                <div class="card-body d-flex flex-column justify-content-between">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h6 class="mb-2">Total Pelanggan</h6>
                            <h2 class="mb-0">{{ $totalPelanggan }}</h2>
                        </div>
                        <i class="fas fa-users fa-2x opacity-75"></i>
                    </div>
                    <small class="opacity-75 mt-2">
                        {{ $pelangganAktif }} akun aktif
                    </small>
                </div>
            </div>
        </div>
        
        <!-- Total Produk -->
        <div class="col-md-3 mb-3">
            <div class="card bg-success text-white h-100">
                <div class="card-body d-flex flex-column justify-content-between">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h6 class="mb-2">Total Produk</h6>
                            <h2 class="mb-0">{{ $totalProduk }}</h2>
                        </div>
                        <i class="fas fa-box fa-2x opacity-75"></i>
                    </div>
                    <small class="opacity-75 mt-2">
                        {{ $produkTersedia }} tersedia
                    </small>
                </div>
            </div>
        </div>
        
        <!-- Total Kategori -->
        <div class="col-md-3 mb-3">
            <div class="card bg-info text-white h-100">
                <div class="card-body d-flex flex-column justify-content-between">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h6 class="mb-2">Total Kategori</h6>
                            <h2 class="mb-0">{{ $totalKategori }}</h2>
                        </div>
                        <i class="fas fa-tags fa-2x opacity-75"></i>
                    </div>
                    <small class="opacity-75 mt-2">
                        {{ $produkTerbanyak }} produk terbanyak
                    </small>
                </div>
            </div>
        </div>
        
        <!-- Total Admin/Kasir -->
        <div class="col-md-3 mb-3">
            <div class="card bg-warning text-white h-100">
                <div class="card-body d-flex flex-column justify-content-between">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h6 class="mb-2">Total Staff</h6>
                            <h2 class="mb-0">{{ $totalAdmin + $totalKasir }}</h2>
                        </div>
                        <i class="fas fa-user-shield fa-2x opacity-75"></i>
                    </div>
                    <small class="opacity-75 mt-2">
                        {{ $totalAdmin }} admin, {{ $totalKasir }} kasir
                    </small>
                </div>
            </div>
        </div>
    </div>

    <!-- Row 2: Statistik Detail -->
    <div class="row mb-4">
        <!-- Statistik Produk Detail -->
        <div class="col-md-6 mb-3">
            <div class="card h-100">
                <div class="card-header bg-white py-3 border-bottom">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">
                            <i class="fas fa-chart-pie text-primary me-2"></i>
                            Statistik Produk
                        </h5>
                        <a href="{{ route('admin.produk.index') }}" class="btn btn-sm btn-outline-primary">
                            <i class="fas fa-external-link-alt me-1"></i>Detail
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-6 mb-3">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <div class="bg-success text-white rounded-circle p-2 me-3">
                                        <i class="fas fa-check-circle"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-0">Tersedia</h6>
                                    <h4 class="mb-0">{{ $produkTersedia }}</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 mb-3">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <div class="bg-warning text-white rounded-circle p-2 me-3">
                                        <i class="fas fa-exclamation-triangle"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-0">Stok Rendah</h6>
                                    <h4 class="mb-0">{{ $produkStokRendah }}</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <div class="bg-danger text-white rounded-circle p-2 me-3">
                                        <i class="fas fa-times-circle"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-0">Habis</h6>
                                    <h4 class="mb-0">{{ $produkHabis }}</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <div class="bg-info text-white rounded-circle p-2 me-3">
                                        <i class="fas fa-chart-bar"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-0">Rata-rata Stok</h6>
                                    <h4 class="mb-0">{{ number_format($rataRataProduk, 1) }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistik Staff -->
        <div class="col-md-6 mb-3">
            <div class="card h-100">
                <div class="card-header bg-white py-3 border-bottom">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">
                            <i class="fas fa-user-shield text-warning me-2"></i>
                            Statistik Staff
                        </h5>
                        <a href="{{ route('admin.users.index') }}" class="btn btn-sm btn-outline-warning">
                            <i class="fas fa-external-link-alt me-1"></i>Detail
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-6 mb-3">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <div class="bg-danger text-white rounded-circle p-2 me-3">
                                        <i class="fas fa-user-shield"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-0">Admin</h6>
                                    <h4 class="mb-0">{{ $totalAdmin }}</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 mb-3">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <div class="bg-info text-white rounded-circle p-2 me-3">
                                        <i class="fas fa-cash-register"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-0">Kasir</h6>
                                    <h4 class="mb-0">{{ $totalKasir }}</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <div class="bg-success text-white rounded-circle p-2 me-3">
                                        <i class="fas fa-check-circle"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-0">Aktif</h6>
                                    <h4 class="mb-0">{{ $adminAktif }}</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <div class="bg-secondary text-white rounded-circle p-2 me-3">
                                        <i class="fas fa-user-slash"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-0">Nonaktif</h6>
                                    <h4 class="mb-0">{{ $adminNonaktif }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Row 3: Data Terbaru -->
    <div class="row">
        <!-- Produk Terbaru -->
        <div class="col-md-4 mb-3">
            <div class="card h-100">
                <div class="card-header bg-white py-3 border-bottom">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">
                            <i class="fas fa-box text-success me-2"></i>
                            Produk Terbaru
                        </h5>
                        <a href="{{ route('admin.produk.index') }}" class="btn btn-sm btn-outline-success">
                            <i class="fas fa-list me-1"></i>Semua
                        </a>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="list-group list-group-flush">
                        @forelse($produkTerbaru as $produk)
                        <a href="{{ route('admin.produk.show', $produk->id) }}" 
                           class="list-group-item list-group-item-action border-0 py-3">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0 me-3">
                                    @if($produk->gambar)
                                        <img src="{{ asset('storage/' . $produk->gambar) }}" 
                                             alt="{{ $produk->nama_produk }}"
                                             class="rounded"
                                             style="width: 40px; height: 40px; object-fit: cover;">
                                    @else
                                        <div class="bg-light rounded d-flex align-items-center justify-content-center" 
                                             style="width: 40px; height: 40px;">
                                            <i class="fas fa-box text-muted"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-1">{{ Str::limit($produk->nama_produk, 25) }}</h6>
                                    <div class="d-flex justify-content-between">
                                        <small class="text-muted">
                                            <i class="fas fa-tag me-1"></i>
                                            {{ $produk->kategori->nama_kategori ?? '-' }}
                                        </small>
                                        <small class="text-success fw-bold">
                                            Rp {{ number_format($produk->harga, 0, ',', '.') }}
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </a>
                        @empty
                        <div class="list-group-item border-0 py-4 text-center">
                            <i class="fas fa-box fa-2x text-muted mb-2"></i>
                            <p class="text-muted mb-0">Belum ada produk</p>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        <!-- Pelanggan Terbaru -->
        <div class="col-md-4 mb-3">
            <div class="card h-100">
                <div class="card-header bg-white py-3 border-bottom">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">
                            <i class="fas fa-users text-primary me-2"></i>
                            Pelanggan Terbaru
                        </h5>
                        <a href="{{ route('admin.pelanggan.index') }}" class="btn btn-sm btn-outline-primary">
                            <i class="fas fa-list me-1"></i>Semua
                        </a>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="list-group list-group-flush">
                        @forelse($pelangganTerbaru as $pelanggan)
                        <a href="{{ route('admin.pelanggan.show', $pelanggan->id) }}" 
                           class="list-group-item list-group-item-action border-0 py-3">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0 me-3">
                                    <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" 
                                         style="width: 40px; height: 40px;">
                                        <i class="fas fa-user"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-1">{{ Str::limit($pelanggan->nama_pelanggan, 25) }}</h6>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <small class="text-muted">
                                            <i class="fas fa-phone me-1"></i>
                                            {{ $pelanggan->nomor_telepon }}
                                        </small>
                                        <span class="badge {{ $pelanggan->user ? 'bg-success' : 'bg-warning' }} badge-sm">
                                            {{ $pelanggan->user ? 'Aktif' : 'Non-Aktif' }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </a>
                        @empty
                        <div class="list-group-item border-0 py-4 text-center">
                            <i class="fas fa-users fa-2x text-muted mb-2"></i>
                            <p class="text-muted mb-0">Belum ada pelanggan</p>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        <!-- Kategori Terbaru -->
        <div class="col-md-4 mb-3">
            <div class="card h-100">
                <div class="card-header bg-white py-3 border-bottom">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">
                            <i class="fas fa-tags text-info me-2"></i>
                            Kategori Terbaru
                        </h5>
                        <a href="{{ route('admin.kategori.index') }}" class="btn btn-sm btn-outline-info">
                            <i class="fas fa-list me-1"></i>Semua
                        </a>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="list-group list-group-flush">
                        @forelse($kategoriTerbaru as $kategori)
                        <a href="{{ route('admin.kategori.show', $kategori->id) }}" 
                           class="list-group-item list-group-item-action border-0 py-3">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0 me-3">
                                    <div class="bg-info text-white rounded-circle d-flex align-items-center justify-content-center" 
                                         style="width: 40px; height: 40px;">
                                        <i class="fas fa-tag"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-1">{{ Str::limit($kategori->nama_kategori, 25) }}</h6>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <small class="text-muted">
                                            {{ $kategori->created_at->format('d/m/Y') }}
                                        </small>
                                        <span class="badge bg-primary badge-sm">
                                            {{ $kategori->produk_count ?? 0 }} produk
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </a>
                        @empty
                        <div class="list-group-item border-0 py-4 text-center">
                            <i class="fas fa-tags fa-2x text-muted mb-2"></i>
                            <p class="text-muted mb-0">Belum ada kategori</p>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-white py-3 border-bottom">
                    <h5 class="mb-0">
                        <i class="fas fa-bolt text-danger me-2"></i>
                        Quick Actions
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-3 col-6">
                            <a href="{{ route('admin.produk.create') }}" class="btn btn-outline-success w-100 h-100 py-3">
                                <i class="fas fa-plus-circle fa-2x mb-2"></i>
                                <h6 class="mb-0">Tambah Produk</h6>
                            </a>
                        </div>
                        <div class="col-md-3 col-6">
                            <a href="{{ route('admin.kategori.create') }}" class="btn btn-outline-info w-100 h-100 py-3">
                                <i class="fas fa-tag fa-2x mb-2"></i>
                                <h6 class="mb-0">Tambah Kategori</h6>
                            </a>
                        </div>
                        <div class="col-md-3 col-6">
                            <a href="{{ route('admin.users.create') }}" class="btn btn-outline-warning w-100 h-100 py-3">
                                <i class="fas fa-user-plus fa-2x mb-2"></i>
                                <h6 class="mb-0">Tambah Staff</h6>
                            </a>
                        </div>
                        <div class="col-md-3 col-6">
                            <a href="{{ route('admin.pelanggan.index') }}" class="btn btn-outline-primary w-100 h-100 py-3">
                                <i class="fas fa-users fa-2x mb-2"></i>
                                <h6 class="mb-0">Lihat Pelanggan</h6>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Auto refresh waktu setiap menit
        function updateTime() {
            const now = new Date();
            const options = { 
                weekday: 'long', 
                year: 'numeric', 
                month: 'long', 
                day: 'numeric',
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit'
            };
            const timeElement = document.querySelector('.fa-clock').parentElement;
            if (timeElement) {
                timeElement.innerHTML = `<i class="fas fa-clock me-1"></i>${now.toLocaleDateString('id-ID', options)}`;
            }
        }
        
        // Update waktu setiap 60 detik
        setInterval(updateTime, 60000);
        
        // Inisialisasi tooltips jika ada
        if (typeof bootstrap !== 'undefined') {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        }
    });
</script>
@endsection
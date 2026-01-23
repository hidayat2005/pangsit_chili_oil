@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')
    <!-- Welcome Banner -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="glass-card p-4">
                <h2 class="fw-bold mb-1">Selamat Datang, {{ Auth::user()->name ?? 'Admin' }}!</h2>
                <p class="text-muted mb-0">Berikut adalah ikhtisar performa Pangsit Chili Oil hari ini.</p>
            </div>
        </div>
    </div>

    <!-- Statistik Utama -->
    <div class="row g-4 mb-4">
        <!-- Total Pelanggan -->
        <div class="col-xl-3 col-md-6">
            <div class="card h-100" style="border-left: 5px solid #0ea5e9 !important;">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="rounded-circle d-flex align-items-center justify-content-center" 
                             style="width: 50px; height: 50px; background: rgba(14, 165, 233, 0.1); color: #0ea5e9;">
                            <i class="fas fa-users fs-4"></i>
                        </div>
                    </div>
                    <div>
                        <h6 class="text-muted fw-bold text-uppercase mb-1" style="font-size: 0.75rem; letter-spacing: 0.05em;">Total Pelanggan</h6>
                        <h2 class="fw-bold mb-0 text-dark">{{ $totalPelanggan }}</h2>
                    </div>
                    <div class="mt-2 small text-muted">
                        <i class="fas fa-check-circle text-success me-1"></i> {{ $pelangganAktif }} Akun Aktif
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Total Produk -->
        <div class="col-xl-3 col-md-6">
            <div class="card h-100" style="border-left: 5px solid var(--primary-red) !important;">
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
                    <div class="mt-2 small text-muted">
                        <i class="fas fa-warehouse text-primary me-1"></i> {{ $produkTersedia }} Tersedia
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Total Kategori -->
        <div class="col-xl-3 col-md-6">
            <div class="card h-100" style="border-left: 5px solid var(--accent-orange) !important;">
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
                    <div class="mt-2 small text-muted">
                        <i class="fas fa-chart-line text-warning me-1"></i> {{ $produkTerbanyak }} Produk Terbanyak
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Total Staff -->
        <div class="col-xl-3 col-md-6">
            <div class="card h-100" style="border-left: 5px solid #8b5cf6 !important;">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="rounded-circle d-flex align-items-center justify-content-center" 
                             style="width: 50px; height: 50px; background: rgba(139, 92, 246, 0.1); color: #8b5cf6;">
                            <i class="fas fa-user-shield fs-4"></i>
                        </div>
                    </div>
                    <div>
                        <h6 class="text-muted fw-bold text-uppercase mb-1" style="font-size: 0.75rem; letter-spacing: 0.05em;">Total Staff</h6>
                        <h2 class="fw-bold mb-0 text-dark">{{ $totalAdmin + $totalKasir }}</h2>
                    </div>
                    <div class="mt-2 small text-muted">
                        {{ $totalAdmin }} Admin, {{ $totalKasir }} Kasir
                    </div>
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
@extends('layouts.admin')

@section('title', 'Manajemen Kategori')

@section('content')
    <!-- Header -->
    <div class="row mb-4">
        <div class="col">
            <div class="glass-card p-4 d-flex justify-content-between align-items-center flex-wrap gap-3">
                <div>
                    <h2 class="fw-bold mb-1">Daftar Kategori</h2>
                    <p class="text-muted mb-0">Kelola kategori produk untuk menu Pangsit Chili Oil Anda.</p>
                </div>
                <a href="{{ route('admin.kategori.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i>Tambah Kategori Baru
                </a>
            </div>
        </div>
    </div>

    <!-- Statistik Kategori -->
    <div class="row g-4 mb-4">
        <div class="col-xl-3 col-md-6">
            <div class="card h-100" style="border-left: 5px solid #ec4899 !important;">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="rounded-circle d-flex align-items-center justify-content-center" 
                             style="width: 45px; height: 45px; background: rgba(236, 72, 153, 0.1); color: #ec4899;">
                            <i class="fas fa-tags fs-5"></i>
                        </div>
                    </div>
                    <div>
                        <h6 class="text-muted fw-bold text-uppercase mb-1" style="font-size: 0.7rem; letter-spacing: 0.05em;">Total Kategori</h6>
                        <h3 class="fw-bold mb-0 text-dark">{{ $totalKategori }}</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card h-100" style="border-left: 5px solid #f59e0b !important;">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="rounded-circle d-flex align-items-center justify-content-center" 
                             style="width: 45px; height: 45px; background: rgba(245, 158, 11, 0.1); color: #f59e0b;">
                            <i class="fas fa-crown fs-5"></i>
                        </div>
                    </div>
                    <div>
                        <h6 class="text-muted fw-bold text-uppercase mb-1" style="font-size: 0.7rem; letter-spacing: 0.05em;">Kategori Favorit</h6>
                        <h5 class="fw-bold mb-0 text-dark truncate">{{ $kategoriTerpopuler->nama_kategori ?? '-' }}</h5>
                        <small class="text-muted">{{ $produkTerbanyak ?? 0 }} Produk</small>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card h-100" style="border-left: 5px solid #3b82f6 !important;">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="rounded-circle d-flex align-items-center justify-content-center" 
                             style="width: 45px; height: 45px; background: rgba(59, 130, 246, 0.1); color: #3b82f6;">
                            <i class="fas fa-box fs-5"></i>
                        </div>
                    </div>
                    <div>
                        <h6 class="text-muted fw-bold text-uppercase mb-1" style="font-size: 0.7rem; letter-spacing: 0.05em;">Total Unit</h6>
                        <h3 class="fw-bold mb-0 text-dark">{{ $totalProduk }}</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card h-100" style="border-left: 5px solid #8b5cf6 !important;">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="rounded-circle d-flex align-items-center justify-content-center" 
                             style="width: 45px; height: 45px; background: rgba(139, 92, 246, 0.1); color: #8b5cf6;">
                            <i class="fas fa-chart-line fs-5"></i>
                        </div>
                    </div>
                    <div>
                        <h6 class="text-muted fw-bold text-uppercase mb-1" style="font-size: 0.7rem; letter-spacing: 0.05em;">Rata-rata</h6>
                        <h3 class="fw-bold mb-0 text-dark">{{ number_format($rataRataProduk, 1) }}</h3>
                        <small class="text-muted">Produk / Kategori</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="row">
        <div class="col-12">
            <div class="table-card p-0">
                <div class="card-header bg-white py-4 px-4 border-bottom d-flex align-items-center justify-content-between">
                    <h5 class="fw-bold mb-0">Daftar Kategori</h5>
                    <span class="text-muted small">Total: {{ $kategoris instanceof \Illuminate\Pagination\LengthAwarePaginator ? $kategoris->total() : $kategoris->count() }} Kategori</span>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th class="text-center" width="60">No</th>
                                <th>Kategori</th>
                                <th>Deskripsi</th>
                                <th class="text-center" width="150">Jumlah Produk</th>
                                <th class="text-center" width="150">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $startNumber = 1;
                                if ($kategoris instanceof \Illuminate\Pagination\LengthAwarePaginator) {
                                    $startNumber = ($kategoris->currentPage() - 1) * $kategoris->perPage() + 1;
                                }
                            @endphp
                            
                            @forelse($kategoris as $index => $kategori)
                            <tr>
                                <td class="text-center align-middle fw-bold text-muted">
                                    {{ $startNumber + $index }}
                                </td>
                                <td class="align-middle">
                                    <div class="fw-bold text-dark">{{ $kategori->nama_kategori }}</div>
                                    <small class="text-muted">Dibuat: {{ $kategori->created_at->format('d/m/Y') }}</small>
                                </td>
                                <td class="align-middle">
                                    @if($kategori->deskripsi)
                                        <div class="text-muted small" style="max-width: 300px;">{{ Str::limit($kategori->deskripsi, 80) }}</div>
                                    @else
                                        <span class="text-muted fst-italic small">Tidak ada deskripsi</span>
                                    @endif
                                </td>
                                <td class="text-center align-middle">
                                    <span class="badge {{ $kategori->produk_count > 5 ? 'bg-success' : 'bg-primary' }} rounded-pill px-3">
                                        {{ $kategori->produk_count ?? $kategori->produk->count() }} Produk
                                    </span>
                                </td>
                                <td class="text-center align-middle">
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('admin.kategori.edit', $kategori->id) }}" class="btn btn-sm btn-light border" title="Edit">
                                            <i class="fas fa-edit text-warning"></i>
                                        </a>
                                        <form action="{{ route('admin.kategori.destroy', $kategori->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-light border" title="Hapus">
                                                <i class="fas fa-trash text-danger"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center py-5">
                                    <div class="mb-3"><i class="fas fa-tags fa-4x text-muted opacity-25"></i></div>
                                    <h5 class="text-muted">Belum ada kategori.</h5>
                                    <a href="{{ route('admin.kategori.create') }}" class="btn btn-primary mt-3">Tambah Kategori Pertama</a>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($kategoris instanceof \Illuminate\Pagination\LengthAwarePaginator && $kategoris->hasPages())
                <div class="px-4 py-3 border-top">
                    <div class="d-flex justify-content-between align-items-center flex-wrap">
                        <small class="text-muted">Menampilkan {{ $kategoris->firstItem() }}-{{ $kategoris->lastItem() }} dari {{ $kategoris->total() }} kategori</small>
                        {{ $kategoris->links() }}
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
@endsection
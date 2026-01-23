@extends('layouts.admin')

@section('title', 'Manajemen Produk')

@section('content')
    <!-- Header -->
    <div class="row mb-4">
        <div class="col">
            <div class="glass-card p-4 d-flex justify-content-between align-items-center flex-wrap gap-3">
                <div>
                    <h2 class="fw-bold mb-1 text-dark">Manajemen Produk</h2>
                    <p class="text-muted mb-0">Atur ketersediaan dan harga menu Pangsit Chili Oil Anda.</p>
                </div>
                <a href="{{ route('admin.produk.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i>Tambah Produk Baru
                </a>
            </div>
        </div>
    </div>

    <!-- Statistik Produk -->
    <div class="row g-4 mb-4">
        <div class="col-xl-3 col-md-6">
            <div class="card h-100" style="border-left: 5px solid #6366f1 !important;">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="rounded-circle d-flex align-items-center justify-content-center" 
                             style="width: 45px; height: 45px; background: rgba(99, 102, 241, 0.1); color: #6366f1;">
                            <i class="fas fa-box fs-5"></i>
                        </div>
                    </div>
                    <div>
                        <h6 class="text-muted fw-bold text-uppercase mb-1" style="font-size: 0.7rem; letter-spacing: 0.05em;">Total Produk</h6>
                        <h3 class="fw-bold mb-0 text-dark">{{ $totalProduk }}</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card h-100" style="border-left: 5px solid #10b981 !important;">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="rounded-circle d-flex align-items-center justify-content-center" 
                             style="width: 45px; height: 45px; background: rgba(16, 185, 129, 0.1); color: #10b981;">
                            <i class="fas fa-check-circle fs-5"></i>
                        </div>
                    </div>
                    <div>
                        <h6 class="text-muted fw-bold text-uppercase mb-1" style="font-size: 0.7rem; letter-spacing: 0.05em;">Tersedia</h6>
                        <h3 class="fw-bold mb-0 text-dark">{{ $produkTersedia }}</h3>
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
                            <i class="fas fa-exclamation-triangle fs-5"></i>
                        </div>
                    </div>
                    <div>
                        <h6 class="text-muted fw-bold text-uppercase mb-1" style="font-size: 0.7rem; letter-spacing: 0.05em;">Stok Rendah</h6>
                        <h3 class="fw-bold mb-0 text-dark">{{ $produkStokRendah }}</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card h-100" style="border-left: 5px solid #ef4444 !important;">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="rounded-circle d-flex align-items-center justify-content-center" 
                             style="width: 45px; height: 45px; background: rgba(239, 68, 68, 0.1); color: #ef4444;">
                            <i class="fas fa-times-circle fs-5"></i>
                        </div>
                    </div>
                    <div>
                        <h6 class="text-muted fw-bold text-uppercase mb-1" style="font-size: 0.7rem; letter-spacing: 0.05em;">Habis</h6>
                        <h3 class="fw-bold mb-0 text-dark">{{ $produkHabis }}</h3>
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
                    <h5 class="fw-bold mb-0 text-dark">Data Produk</h5>
                    <span class="text-muted small">Total Produk: <strong>{{ $produks->total() }}</strong></span>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th class="text-center" width="60">No</th>
                                <th width="80">Produk</th>
                                <th>Informasi Menu</th>
                                <th width="150" class="text-center">Kategori</th>
                                <th width="120" class="text-center">Harga</th>
                                <th width="100" class="text-center">Stok</th>
                                <th width="120" class="text-center">Status</th>
                                <th width="150" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($produks as $produk)
                            <tr>
                                <td class="text-center align-middle fw-bold text-muted">
                                    {{ ($produks->currentPage() - 1) * $produks->perPage() + $loop->iteration }}
                                </td>
                                <td class="align-middle">
                                    @if($produk->gambar)
                                        <img src="{{ asset('storage/' . $produk->gambar) }}" 
                                             alt="{{ $produk->nama_produk }}" 
                                             class="rounded shadow-sm border" 
                                             style="width: 60px; height: 60px; object-fit: cover;">
                                    @else
                                        <div class="bg-light rounded border d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                                            <i class="fas fa-image text-muted opacity-50"></i>
                                        </div>
                                    @endif
                                </td>
                                <td class="align-middle">
                                    <div class="fw-bold text-dark">{{ $produk->nama_produk }}</div>
                                    <small class="text-muted">{{ Str::limit($produk->deskripsi, 60) }}</small>
                                </td>
                                <td class="text-center align-middle">
                                    <span class="badge bg-light text-primary border border-primary border-opacity-25 px-3">
                                        {{ $produk->kategori->nama_kategori ?? '-' }}
                                    </span>
                                </td>
                                <td class="text-center align-middle">
                                    <span class="fw-bold text-success">Rp {{ number_format($produk->harga, 0, ',', '.') }}</span>
                                </td>
                                <td class="text-center align-middle">
                                    <div class="fw-bold">{{ $produk->stok }}</div>
                                </td>
                                <td class="text-center align-middle">
                                    @if($produk->status == 'tersedia')
                                        <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 px-3">Tersedia</span>
                                    @else
                                        <span class="badge bg-danger bg-opacity-10 text-danger border border-danger border-opacity-25 px-3">Habis</span>
                                    @endif
                                </td>
                                <td class="text-center align-middle">
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('admin.produk.edit', $produk->id) }}" class="btn btn-sm btn-light border" title="Edit">
                                            <i class="fas fa-edit text-warning"></i>
                                        </a>
                                        <form action="{{ route('admin.produk.destroy', $produk->id) }}" method="POST" class="d-inline">
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
                                <td colspan="8" class="text-center py-5">
                                    <div class="mb-3"><i class="fas fa-box-open fa-4x text-muted opacity-25"></i></div>
                                    <h5 class="text-muted">Produk masih kosong nih!</h5>
                                    <a href="{{ route('admin.produk.create') }}" class="btn btn-primary mt-3">Tambah Produk Pertama</a>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($produks->hasPages())
                <div class="px-4 py-3 border-top">
                    <div class="d-flex justify-content-between align-items-center flex-wrap">
                        <small class="text-muted">Menampilkan {{ $produks->firstItem() }}-{{ $produks->lastItem() }} dari {{ $produks->total() }} produk</small>
                        {{ $produks->links() }}
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Tooltips initialization
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });
</script>
@endpush
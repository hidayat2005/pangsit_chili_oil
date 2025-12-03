@extends('layouts.app')

@section('title', 'Manajemen Produk')

@section('content')
<div class="container-fluid py-4">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h3 class="mb-1">Daftar Produk</h3>
                    <p class="text-muted mb-0">Kelola produk Pangsit Chili Oil</p>
                </div>
                <a href="{{ route('produk.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-1"></i>Tambah Produk
                </a>
            </div>
        </div>
    </div>

    <!-- HANYA SATU NOTIFIKASI DISINI -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Main Content -->
    <div class="row">
        <div class="col-12">
            <!-- Product Table Card -->
            <div class="card shadow-sm border-0">
                <!-- Card Header -->
                <div class="card-header bg-white py-3 border-bottom">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <h5 class="mb-0">Semua Produk</h5>
                        </div>
                        <div class="col-md-6 text-md-end">
                            <span class="text-muted">
                                Total: <strong>{{ $produks->total() }}</strong> produk
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Card Body -->
                <div class="card-body p-0">
                    <!-- HAPUS NOTIFIKASI DISINI -->
                    
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="py-3 px-4" width="50">No</th>
                                    <th class="py-3 px-4" width="70">Gambar</th>
                                    <th class="py-3 px-4">Nama Produk</th>
                                    <th class="py-3 px-4" width="120">Kategori</th>
                                    <th class="py-3 px-4" width="120">Harga</th>
                                    <th class="py-3 px-4" width="80">Stok</th>
                                    <th class="py-3 px-4" width="100">Status</th>
                                    <th class="py-3 px-4 text-center" width="140">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($produks as $produk)
                                <tr>
                                    <td class="px-4 py-3 align-middle">
                                        {{ ($produks->currentPage() - 1) * $produks->perPage() + $loop->iteration }}
                                    </td>
                                    <td class="px-4 py-3 align-middle">
                                        @if($produk->gambar)
                                            <img src="{{ asset('storage/' . $produk->gambar) }}" 
                                                 alt="{{ $produk->nama_produk }}" 
                                                 class="rounded" 
                                                 style="width: 50px; height: 50px; object-fit: cover;">
                                        @else
                                            <div class="bg-light rounded d-flex align-items-center justify-content-center" 
                                                 style="width: 50px; height: 50px;">
                                                <i class="fas fa-image text-muted"></i>
                                            </div>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 align-middle">
                                        <div>
                                            <strong class="d-block mb-1">{{ $produk->nama_produk }}</strong>
                                            @if($produk->deskripsi)
                                                <small class="text-muted">{{ Str::limit($produk->deskripsi, 40) }}</small>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 align-middle">
                                        <span class="badge bg-primary">
                                            {{ $produk->kategori->nama_kategori ?? '-' }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3 align-middle">
                                        <div class="d-flex align-items-center">
                                            <span class="text-success me-1">Rp</span>
                                            <strong class="text-success">
                                                {{ number_format($produk->harga, 0, ',', '.') }}
                                            </strong>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 align-middle">
                                        <span class="badge {{ $produk->stok > 10 ? 'bg-success' : ($produk->stok > 0 ? 'bg-warning' : 'bg-danger') }}">
                                            {{ $produk->stok }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3 align-middle">
                                        <span class="badge {{ $produk->status == 'tersedia' ? 'bg-success' : 'bg-danger' }}">
                                            {{ $produk->status == 'tersedia' ? 'Tersedia' : 'Habis' }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3 align-middle text-center">
                                        <div class="btn-group btn-group-sm">
                                            <a href="{{ route('produk.show', $produk->id) }}" 
                                               class="btn btn-outline-info px-3" 
                                               title="Detail">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('produk.edit', $produk->id) }}" 
                                               class="btn btn-outline-warning px-3" 
                                               title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('produk.destroy', $produk->id) }}" method="POST" 
                                                  class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="btn btn-outline-danger px-3" 
                                                        title="Hapus"
                                                        onclick="return confirm('Hapus produk ini?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8" class="text-center py-5">
                                        <div class="py-4">
                                            <i class="fas fa-box fa-3x text-muted mb-3"></i>
                                            <h5 class="text-muted">Belum ada produk</h5>
                                            <p class="text-muted mb-4">Mulai dengan menambahkan produk pertama Anda</p>
                                            <a href="{{ route('produk.create') }}" class="btn btn-primary">
                                                <i class="fas fa-plus me-2"></i>Tambah Produk
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if($produks->hasPages())
                    <div class="card-footer bg-white border-top py-3">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <div class="text-muted">
                                    Menampilkan {{ $produks->firstItem() ?? 0 }} sampai {{ $produks->lastItem() ?? 0 }} 
                                    dari {{ $produks->total() }} produk
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex justify-content-md-end">
                                    {{ $produks->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Script sederhana untuk konfirmasi hapus
    document.addEventListener('DOMContentLoaded', function() {
        const deleteForms = document.querySelectorAll('form[action*="destroy"]');
        deleteForms.forEach(form => {
            form.addEventListener('submit', function(e) {
                if (!confirm('Apakah Anda yakin ingin menghapus produk ini?')) {
                    e.preventDefault();
                }
            });
        });
    });
</script>
@endsection
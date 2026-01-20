@extends('layouts.app')

@section('title', 'Manajemen Kategori')

@section('content')
    <!-- Header -->
    <div class="row mb-4">
        <div class="col">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h3 class="mb-1">Daftar Kategori</h3>
                    <p class="text-muted mb-0">Kelola kategori produk Pangsit Chili Oil</p>
                </div>
                <a href="{{ route('admin.kategori.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-1"></i>Tambah Kategori
                </a>
            </div>
        </div>
    </div>

    <!-- Statistik Kategori -->
<div class="row mb-4">
    <div class="col-md-3 mb-3">
        <div class="card bg-primary text-white h-100">
            <div class="card-body d-flex flex-column justify-content-between">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <h6 class="mb-2">Total Kategori</h6>
                        <h2 class="mb-0">{{ $totalKategori }}</h2>
                    </div>
                    <i class="fas fa-tags fa-2x opacity-75"></i>
                </div>
                <small class="opacity-75 mt-2">
                    Jumlah semua kategori
                </small>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="card bg-success text-white h-100">
            <div class="card-body d-flex flex-column justify-content-between">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <h6 class="mb-2">Kategori Terpopuler</h6>
                        <h4 class="mb-0">{{ $kategoriTerpopuler->nama_kategori ?? '-' }}</h4>
                    </div>
                    <i class="fas fa-crown fa-2x opacity-75"></i>
                </div>
                <small class="opacity-75 mt-2">
                    {{ $produkTerbanyak ?? 0 }} produk
                </small>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="card bg-info text-white h-100">
            <div class="card-body d-flex flex-column justify-content-between">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <h6 class="mb-2">Total Produk</h6>
                        <h2 class="mb-0">{{ $totalProduk }}</h2>
                    </div>
                    <i class="fas fa-box fa-2x opacity-75"></i>
                </div>
                <small class="opacity-75 mt-2">
                    Jumlah semua produk
                </small>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="card bg-warning text-white h-100">
            <div class="card-body d-flex flex-column justify-content-between">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <h6 class="mb-2">Rata-rata Produk</h6>
                        <h2 class="mb-0">{{ number_format($rataRataProduk, 1) }}</h2>
                    </div>
                    <i class="fas fa-chart-bar fa-2x opacity-75"></i>
                </div>
                <small class="opacity-75 mt-2">
                    per kategori
                </small>
            </div>
        </div>
    </div>
</div>



    <!-- Main Content -->
    <div class="row">
        <div class="col-12">
            <!-- Kategori Table Card -->
            <div class="card shadow-sm border-0">
                <!-- Card Header -->
                <div class="card-header bg-white py-3 border-bottom">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <h5 class="mb-0">Semua Kategori</h5>
                        </div>
                        <div class="col-md-6 text-md-end">
                            <span class="text-muted">
                                Total: <strong>{{ $kategoris instanceof \Illuminate\Pagination\LengthAwarePaginator ? $kategoris->total() : $kategoris->count() }}</strong> kategori
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Card Body -->
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="py-3 px-4" width="50">No</th>
                                    <th class="py-3 px-4">Nama Kategori</th>
                                    <th class="py-3 px-4" width="250">Deskripsi</th>
                                    <th class="py-3 px-4" width="120" class="text-center">Jumlah Produk</th>
                                    <th class="py-3 px-4 text-center" width="140">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    // Hitung nomor urut berdasarkan pagination atau collection
                                    $startNumber = 1;
                                    if ($kategoris instanceof \Illuminate\Pagination\LengthAwarePaginator) {
                                        $startNumber = ($kategoris->currentPage() - 1) * $kategoris->perPage() + 1;
                                    }
                                @endphp
                                
                                @forelse($kategoris as $index => $kategori)
                                <tr>
                                    <td class="px-4 py-3 align-middle">
                                        {{ $startNumber + $index }}
                                    </td>
                                    <td class="px-4 py-3 align-middle">
                                        <div>
                                            <strong class="d-block mb-1">{{ $kategori->nama_kategori }}</strong>
                                            <small class="text-muted">
                                                Dibuat: {{ $kategori->created_at->format('d/m/Y') }}
                                            </small>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 align-middle">
                                        @if($kategori->deskripsi)
                                            {{ Str::limit($kategori->deskripsi, 80) }}
                                        @else
                                            <span class="text-muted fst-italic">Tidak ada deskripsi</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 align-middle text-center">
                                        <span class="badge {{ $kategori->produk_count > 10 ? 'bg-success' : ($kategori->produk_count > 0 ? 'bg-primary' : 'bg-secondary') }}">
                                            {{ $kategori->produk_count ?? $kategori->produk->count() }} produk
                                        </span>
                                    </td>
                                    <td class="px-4 py-3 align-middle text-center">
                                        <div class="btn-group btn-group-sm">
                                            <a href="{{ route('admin.kategori.show', $kategori->id) }}" 
                                               class="btn btn-outline-info px-3" 
                                               title="Detail">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.kategori.edit', $kategori->id) }}" 
                                               class="btn btn-outline-warning px-3" 
                                               title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.kategori.destroy', $kategori->id) }}" method="POST" 
                                                  class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="btn btn-outline-danger px-3" 
                                                        title="Hapus">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center py-5">
                                        <div class="py-4">
                                            <i class="fas fa-tags fa-3x text-muted mb-3"></i>
                                            <h5 class="text-muted">Belum ada kategori</h5>
                                            <p class="text-muted mb-4">Mulai dengan menambahkan kategori pertama Anda</p>
                                            <a href="{{ route('admin.kategori.create') }}" class="btn btn-primary">
                                                <i class="fas fa-plus me-2"></i>Tambah Kategori
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination - Hanya tampilkan jika $kategoris adalah Paginator -->
                    @if($kategoris instanceof \Illuminate\Pagination\LengthAwarePaginator && $kategoris->hasPages())
                    <div class="card-footer bg-white border-top py-3">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <div class="text-muted">
                                    Menampilkan {{ $kategoris->firstItem() }} sampai {{ $kategoris->lastItem() }} 
                                    dari {{ $kategoris->total() }} kategori
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex justify-content-md-end">
                                    {{ $kategoris->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
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
                if (!confirm('Apakah Anda yakin ingin menghapus kategori ini?')) {
                    e.preventDefault();
                }
            });
        });
    });
</script>
@endsection
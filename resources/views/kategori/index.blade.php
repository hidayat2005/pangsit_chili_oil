@extends('layouts.app')

@section('title', 'Kategori')

@section('content')
<style>
    /* CSS SEDERHANA UNTUK KATEGORI - FULLSCREEN */
    .category-table-container {
        background: white;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        overflow: hidden;
        margin: 0 -15px;
    }
    
    .table-header {
        background: #f8f9fa;
        padding: 1.5rem;
        border-bottom: 1px solid #dee2e6;
    }
    
    .category-table {
        width: 100%;
        margin-bottom: 0;
    }
    
    .category-table th {
        background-color: #f1f3f5;
        padding: 1rem;
        font-weight: 600;
        border-bottom: 2px solid #dee2e6;
    }
    
    .category-table td {
        padding: 1rem;
        border-bottom: 1px solid #dee2e6;
        vertical-align: middle;
    }
    
    .category-table tr:hover {
        background-color: #f8f9fa;
    }
    
    .badge {
        font-size: 0.85rem;
        padding: 0.35rem 0.65rem;
    }
    
    .btn-action {
        padding: 0.25rem 0.5rem;
        font-size: 0.85rem;
        margin: 0 2px;
    }
    
    .empty-state {
        padding: 3rem 1rem;
        text-align: center;
        color: #6c757d;
    }
    
    .pagination-container {
        padding: 1rem;
        background: #f8f9fa;
        border-top: 1px solid #dee2e6;
    }
</style>

<div class="container-fluid py-4">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="mb-1">Daftar Kategori</h3>
            <p class="text-muted mb-0">Kelola kategori produk</p>
        </div>
        <a href="{{ route('kategori.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Kategori
        </a>
    </div>

    <!-- Table -->
    <div class="category-table-container">
        <div class="table-header">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="mb-0">Semua Kategori</h5>
                </div>
                <div class="col-md-6 text-md-end">
                    <span class="text-muted">
                        Total: <strong>{{ $kategoris->count() }}</strong> kategori
                    </span>
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table category-table">
                <thead>
                    <tr>
                        <th width="50">No</th>
                        <th>Nama Kategori</th>
                        <th width="250">Deskripsi</th>
                        <th width="120" class="text-center">Jumlah Produk</th>
                        <th width="150" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($kategoris as $kategori)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <strong class="d-block">{{ $kategori->nama_kategori }}</strong>
                            <small class="text-muted">
                                Dibuat: {{ $kategori->created_at->format('d/m/Y') }}
                            </small>
                        </td>
                        <td>
                            @if($kategori->deskripsi)
                                {{ Str::limit($kategori->deskripsi, 80) }}
                            @else
                                <span class="text-muted fst-italic">Tidak ada deskripsi</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <span class="badge bg-light text-dark border">
                                {{ $kategori->produk_count ?? $kategori->produk->count() }} produk
                            </span>
                        </td>
                        <td class="text-center">
                            <div class="btn-group" role="group">
                                <a href="{{ route('kategori.show', $kategori->id) }}" 
                                   class="btn btn-sm btn-outline-info btn-action" title="Detail">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('kategori.edit', $kategori->id) }}" 
                                   class="btn btn-sm btn-outline-warning btn-action" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('kategori.destroy', $kategori->id) }}" method="POST" 
                                      class="d-inline" onsubmit="return confirm('Hapus kategori ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger btn-action" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5">
                            <div class="empty-state">
                                <i class="fas fa-tags fa-3x mb-3"></i>
                                <h5>Belum ada kategori</h5>
                                <p class="mb-3">Mulai dengan menambahkan kategori pertama Anda</p>
                                <a href="{{ route('kategori.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus me-2"></i>Tambah Kategori
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Jika ada pagination -->
        @if(method_exists($kategoris, 'hasPages') && $kategoris->hasPages())
        <div class="pagination-container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="text-muted">
                        Menampilkan {{ $kategoris->firstItem() ?? 0 }} sampai {{ $kategoris->lastItem() ?? 0 }} dari {{ $kategoris->total() }} kategori
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

<script>
    // Script sederhana untuk konfirmasi hapus
    document.addEventListener('DOMContentLoaded', function() {
        // Tambahkan konfirmasi untuk semua form hapus
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
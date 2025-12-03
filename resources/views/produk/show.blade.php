@extends('layouts.app')

@section('title', 'Detail Produk')

@section('content')
<div class="container py-4">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4>Detail Produk</h4>
        <a href="{{ route('produk.index') }}" class="btn btn-outline-secondary btn-sm">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="row">
        <!-- Gambar Produk -->
        <div class="col-md-5 mb-4">
            <div class="card">
                <div class="card-body text-center p-3">
                    @if($produk->gambar)
                        <img src="{{ asset('storage/' . $produk->gambar) }}" 
                             alt="{{ $produk->nama_produk }}" 
                             class="img-fluid rounded mb-2" 
                             style="height: 320px; width: 100%; object-fit: contain;">
                        <small class="text-muted">Gambar produk</small>
                    @else
                        <div class="d-flex flex-column align-items-center justify-content-center" 
                             style="height: 320px; background-color: #f8f9fa; border-radius: 8px;">
                            <i class="fas fa-image fa-3x text-muted mb-3"></i>
                            <p class="text-muted mb-0">Tidak ada gambar</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Informasi Produk -->
        <div class="col-md-7">
            <!-- Header Produk -->
            <div class="card mb-3">
                <div class="card-body">
                    <h4 class="mb-2">{{ $produk->nama_produk }}</h4>
                    <div class="d-flex align-items-center">
                        <span class="badge bg-primary me-2">
                            {{ $produk->kategori->nama_kategori ?? '-' }}
                        </span>
                        <small class="text-muted">ID: {{ $produk->id }}</small>
                    </div>
                </div>
            </div>

            <!-- Data Produk -->
            <div class="card mb-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <strong class="d-block mb-1">Harga</strong>
                            <div class="d-flex align-items-center">
                                <span class="text-success me-1">Rp</span>
                                <h5 class="text-success mb-0">
                                    {{ number_format($produk->harga, 0, ',', '.') }}
                                </h5>
                            </div>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <strong class="d-block mb-1">Stok</strong>
                            <span class="badge {{ $produk->stok > 10 ? 'bg-success' : ($produk->stok > 0 ? 'bg-warning' : 'bg-danger') }} fs-6">
                                {{ $produk->stok }} unit
                            </span>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <strong class="d-block mb-1">Status</strong>
                            <span class="badge {{ $produk->status == 'tersedia' ? 'bg-success' : 'bg-danger' }}">
                                {{ $produk->status == 'tersedia' ? 'Tersedia' : 'Habis' }}
                            </span>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <strong class="d-block mb-1">Dibuat</strong>
                            <div>{{ $produk->created_at->format('d/m/Y H:i') }}</div>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <strong class="d-block mb-1">Diupdate</strong>
                            <div>{{ $produk->updated_at->format('d/m/Y H:i') }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Deskripsi -->
            <div class="card mb-4">
                <div class="card-body">
                    <h6 class="mb-3">Deskripsi Produk</h6>
                    <div class="bg-light p-3 rounded">
                        @if($produk->deskripsi)
                            <p class="mb-0">{{ $produk->deskripsi }}</p>
                        @else
                            <p class="mb-0 text-muted fst-italic">Tidak ada deskripsi</p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Tombol Aksi -->
            <div class="d-flex justify-content-between">
                <a href="{{ route('produk.edit', $produk->id) }}" class="btn btn-warning px-4">
                    <i class="fas fa-edit me-2"></i> Edit
                </a>
                
                <form action="{{ route('produk.destroy', $produk->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger px-4" 
                            onclick="return confirm('Hapus produk {{ $produk->nama_produk }}?')">
                        <i class="fas fa-trash me-2"></i> Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
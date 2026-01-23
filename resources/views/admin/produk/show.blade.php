@extends('layouts.admin')

@section('title', 'Detail Produk')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-11">
            <!-- Header -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="fw-bold mb-1 text-dark">Detail Produk</h2>
                    <p class="text-muted mb-0">Informasi lengkap spesifikasi produk Pangsit Chili Oil Anda.</p>
                </div>
                <a href="{{ route('admin.produk.index') }}" class="btn btn-light border px-4">
                    <i class="fas fa-arrow-left me-2"></i>Kembali ke Daftar
                </a>
            </div>

            <div class="row g-4">
                <!-- Preview Gambar -->
                <div class="col-md-5">
                    <div class="glass-card p-3 border-0 shadow-lg h-100 bg-white">
                        <div class="inner-card rounded-4 overflow-hidden shadow-sm h-100 d-flex align-items-center justify-content-center bg-light" style="min-height: 400px;">
                            @if($produk->gambar)
                                <img src="{{ asset('storage/' . $produk->gambar) }}" 
                                     alt="{{ $produk->nama_produk }}" 
                                     class="img-fluid w-100 h-100" 
                                     style="object-fit: cover;">
                            @else
                                <div class="text-center p-5">
                                    <i class="fas fa-image fa-4x text-muted opacity-25 mb-3"></i>
                                    <p class="text-muted fw-bold">Tidak ada gambar produk</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Detail Informasi -->
                <div class="col-md-7">
                    <div class="glass-card p-0 border-0 shadow-lg overflow-hidden h-100">
                        <div class="card-header bg-white py-4 px-4 border-bottom d-flex justify-content-between align-items-center">
                            <div>
                                <h3 class="fw-bold text-dark mb-0">{{ $produk->nama_produk }}</h3>
                                <span class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25 px-3 mt-2">
                                    {{ $produk->kategori->nama_kategori ?? 'Tanpa Kategori' }}
                                </span>
                            </div>
                            <div class="text-end">
                                <div class="text-muted small">Status Menu</div>
                                @if($produk->status == 'tersedia')
                                    <span class="badge bg-success rounded-pill px-3 py-2">Tersedia</span>
                                @else
                                    <span class="badge bg-danger rounded-pill px-3 py-2">Habis</span>
                                @endif
                            </div>
                        </div>

                        <div class="card-body p-4">
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <div class="p-3 rounded-4 bg-light border border-white h-100">
                                        <div class="text-muted small text-uppercase fw-bold mb-1">Harga Satuan</div>
                                        <h3 class="fw-bold text-success mb-0">Rp {{ number_format($produk->harga, 0, ',', '.') }}</h3>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="p-3 rounded-4 bg-light border border-white h-100">
                                        <div class="text-muted small text-uppercase fw-bold mb-1">Stok Inventaris</div>
                                        <h3 class="fw-bold text-dark mb-0">{{ $produk->stok }} <span class="fs-6 fw-normal text-muted">Unit</span></h3>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="p-4 rounded-4 bg-white border h-100">
                                        <div class="text-muted small text-uppercase fw-bold mb-3 border-bottom pb-2">Deskripsi Produk</div>
                                        @if($produk->deskripsi)
                                            <p class="text-dark mb-0 leading-relaxed">{{ $produk->deskripsi }}</p>
                                        @else
                                            <p class="text-muted fst-italic mb-0">Pemilik belum memberikan deskripsi untuk menu ini.</p>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-12 mt-4">
                                    <div class="d-flex gap-4 border-top pt-4">
                                        <div class="flex-fill">
                                            <label class="text-muted small text-uppercase fw-bold d-block mb-1">Waktu Input</label>
                                            <div class="fw-bold small">{{ $produk->created_at->format('d F Y, H:i') }}</div>
                                        </div>
                                        <div class="flex-fill text-end">
                                            <label class="text-muted small text-uppercase fw-bold d-block mb-1">Update Terakhir</label>
                                            <div class="fw-bold small">{{ $produk->updated_at->format('d F Y, H:i') }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer bg-light p-4 border-top">
                            <div class="d-flex justify-content-between align-items-center">
                                <a href="{{ route('admin.produk.edit', $produk->id) }}" class="btn btn-warning btn-lg px-5 shadow-sm">
                                    <i class="fas fa-edit me-2"></i>Edit Data
                                </a>
                                <form action="{{ route('admin.produk.destroy', $produk->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-lg px-4" 
                                            onclick="return confirm('Hapus produk {{ $produk->nama_produk }}?')">
                                        <i class="fas fa-trash me-2"></i>Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
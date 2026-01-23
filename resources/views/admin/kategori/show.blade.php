@extends('layouts.admin')

@section('title', 'Detail Kategori')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <!-- Header -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="fw-bold mb-1">Detail Kategori</h2>
                    <p class="text-muted mb-0">Informasi spesifik mengenai klasifikasi menu Anda.</p>
                </div>
                <a href="{{ route('admin.kategori.index') }}" class="btn btn-light border px-4">
                    <i class="fas fa-arrow-left me-2"></i>Kembali
                </a>
            </div>

            <div class="glass-card p-0 border-0 shadow-lg overflow-hidden">
                <div class="card-header bg-white py-4 px-4 border-bottom d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <div class="rounded-circle bg-primary bg-opacity-10 text-primary p-3 me-3">
                            <i class="fas fa-tag fs-4"></i>
                        </div>
                        <h4 class="fw-bold mb-0 text-dark">{{ $kategori->nama_kategori }}</h4>
                    </div>
                    <div class="text-end">
                        <span class="badge bg-info text-dark border px-3 py-2 rounded-pill">ID #{{ $kategori->id }}</span>
                    </div>
                </div>

                <div class="card-body p-4">
                    <div class="row g-4">
                        <div class="col-12">
                            <div class="p-4 rounded-4 bg-light border border-white h-100">
                                <label class="text-muted small text-uppercase fw-bold mb-2 d-block">Deskripsi Kategori</label>
                                @if($kategori->deskripsi)
                                    <p class="text-dark mb-0 fs-5">{{ $kategori->deskripsi }}</p>
                                @else
                                    <p class="text-muted fst-italic mb-0">Belum ada deskripsi yang ditambahkan untuk kategori ini.</p>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="p-3 rounded-4 bg-white border h-100">
                                <label class="text-muted small text-uppercase fw-bold mb-1 d-block">Jumlah Produk Tertaut</label>
                                <h4 class="fw-bold text-primary mb-0">{{ $kategori->produk->count() }} <small class="fw-normal text-muted">Item Menu</small></h4>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="p-3 rounded-4 bg-white border h-100">
                                <label class="text-muted small text-uppercase fw-bold mb-1 d-block">Update Terakhir</label>
                                <h5 class="fw-bold text-dark mb-0">{{ $kategori->updated_at->format('d F Y, H:i') }}</h5>
                            </div>
                        </div>
                        
                        <div class="col-12 mt-4 pt-3 border-top">
                            <div class="text-center">
                                <label class="text-muted small text-uppercase fw-bold mb-1 d-block">Waktu Pembuatan Kategori</label>
                                <p class="text-dark fw-bold">{{ $kategori->created_at->format('l, d F Y - H:i') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer bg-light p-4 border-top">
                    <div class="d-flex justify-content-center gap-3">
                        <a href="{{ route('admin.kategori.edit', $kategori->id) }}" class="btn btn-warning btn-lg px-5 shadow-sm">
                            <i class="fas fa-edit me-2"></i>Edit Informasi
                        </a>
                        <form action="{{ route('admin.kategori.destroy', $kategori->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger btn-lg px-5" 
                                    onclick="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')">
                                <i class="fas fa-trash me-2"></i>Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
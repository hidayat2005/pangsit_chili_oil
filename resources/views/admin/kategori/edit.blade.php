@extends('layouts.admin')

@section('title', 'Edit Kategori')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <!-- Header -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="fw-bold mb-1">Edit Kategori</h2>
                    <p class="text-muted mb-0">Ubah informasi klasifikasi menu Anda.</p>
                </div>
                <a href="{{ route('admin.kategori.index') }}" class="btn btn-light border px-4">
                    <i class="fas fa-arrow-left me-2"></i>Kembali
                </a>
            </div>

            <div class="glass-card p-0 overflow-hidden border-0 shadow-lg">
                <div class="card-header bg-white py-3 border-bottom">
                    <h5 class="fw-bold mb-0 text-dark">
                        <i class="fas fa-edit me-2 text-warning"></i>Formulir Edit Kategori
                    </h5>
                </div>
                
                <div class="card-body p-4">
                    @if($errors->any())
                        <div class="alert alert-danger border-0 shadow-sm mb-4">
                            <div class="fw-bold mb-2 text-danger"><i class="fas fa-exclamation-triangle me-2"></i> Mohon perbaiki kesalahan berikut:</div>
                            <ul class="mb-0 small">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.kategori.update', $kategori->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-4">
                            <label class="form-label fw-bold text-dark small text-uppercase">Nama Kategori <span class="text-danger">*</span></label>
                            <input type="text" name="nama_kategori" 
                                   class="form-control form-control-lg @error('nama_kategori') is-invalid @enderror"
                                   value="{{ old('nama_kategori', $kategori->nama_kategori) }}"
                                   placeholder="Contoh: Pangsit Goreng"
                                   required>
                            @error('nama_kategori')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-0">
                            <label class="form-label fw-bold text-dark small text-uppercase">Deskripsi Kategori</label>
                            <textarea name="deskripsi" rows="5"
                                      class="form-control @error('deskripsi') is-invalid @enderror"
                                      placeholder="Jelaskan detail kategori ini (opsional)..."
                                      >{{ old('deskripsi', $kategori->deskripsi) }}</textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Tombol Aksi -->
                        <div class="d-flex justify-content-between align-items-center mt-5 pt-4 border-top">
                            <div>
                                <a href="{{ route('admin.kategori.show', $kategori->id) }}" class="btn btn-outline-info px-4">
                                    <i class="fas fa-eye me-2"></i>Detail
                                </a>
                                <a href="{{ route('admin.kategori.index') }}" class="btn btn-outline-secondary px-4">
                                    <i class="fas fa-times me-2"></i>Batal
                                </a>
                            </div>
                            <button type="submit" class="btn btn-primary btn-lg px-5 shadow-sm">
                                <i class="fas fa-save me-2"></i>Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('frontend.layouts.front')

@section('title', 'Edit Profil - Pangsit Chili Oil')

@section('content')
<div class="container py-5" style="min-height: 70vh;">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="d-flex align-items-center mb-4">
                <a href="{{ route('customer.profile') }}" class="btn glass-btn-dark me-3">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <h2 class="fw-bold mb-0">Edit <span class="text-danger">Profil</span></h2>
            </div>


            <div class="card glass-card border-0 p-4 shadow-sm">
                <form action="{{ route('customer.profile.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="form-label fw-bold text-dark">Nama Lengkap</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-0"><i class="fas fa-user text-danger"></i></span>
                            <input type="text" name="nama_pelanggan" class="form-control @error('nama_pelanggan') is-invalid @enderror" 
                                   value="{{ old('nama_pelanggan', $pelanggan->nama_pelanggan) }}" required>
                        </div>
                        @error('nama_pelanggan')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold text-dark">Email (Read-only)</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-0"><i class="fas fa-envelope text-muted"></i></span>
                            <input type="email" class="form-control bg-light" value="{{ $pelanggan->email }}" readonly>
                        </div>
                        <small class="text-muted">Email tidak dapat diubah karena terhubung dengan akun login Anda.</small>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold text-dark">Nomor Telepon/WhatsApp</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-0"><i class="fas fa-phone text-danger"></i></span>
                            <input type="text" name="nomor_telepon" class="form-control @error('nomor_telepon') is-invalid @enderror" 
                                   value="{{ old('nomor_telepon', $pelanggan->nomor_telepon) }}" placeholder="Contoh: 08123456789" required>
                        </div>
                        @error('nomor_telepon')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold text-dark">Alamat Pengiriman</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-0"><i class="fas fa-map-marker-alt text-danger"></i></span>
                            <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror" 
                                      rows="3" placeholder="Masukkan alamat lengkap pengiriman..." required>{{ old('alamat', $pelanggan->alamat) }}</textarea>
                        </div>
                        @error('alamat')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-grid mt-2">
                        <button type="submit" class="btn btn-danger btn-lg rounded-pill shadow-sm">
                            <i class="fas fa-save me-2"></i>Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.admin')

@section('title', 'Tambah Admin/Kasir Baru')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <!-- Header -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="fw-bold mb-1">Tambah Staff</h2>
                    <p class="text-muted mb-0">Daftarkan Admin atau Kasir baru untuk membantu operasional.</p>
                </div>
                <a href="{{ route('admin.users.index') }}" class="btn btn-light border px-4">
                    <i class="fas fa-arrow-left me-2"></i>Kembali
                </a>
            </div>

            <div class="glass-card p-0 overflow-hidden border-0 shadow-lg">
                <div class="card-header bg-white py-3 border-bottom">
                    <h5 class="fw-bold mb-0 text-dark">
                        <i class="fas fa-user-plus me-2 text-primary"></i>Formulir Data Staff
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

                    <form action="{{ route('admin.users.store') }}" method="POST">
                        @csrf
                        
                        <div class="row g-4">
                            <!-- Akun Details -->
                            <div class="col-md-6">
                                <div class="p-4 rounded-4 bg-light bg-opacity-50">
                                    <h6 class="fw-bold mb-3 border-bottom pb-2">Informasi Akun</h6>
                                    
                                    <div class="mb-3">
                                        <label class="form-label fw-bold text-dark small text-uppercase">Nama Lengkap <span class="text-danger">*</span></label>
                                        <input type="text" name="nama_lengkap" 
                                               class="form-control @error('nama_lengkap') is-invalid @enderror"
                                               value="{{ old('nama_lengkap') }}"
                                               placeholder="Contoh: Budi Santoso"
                                               required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label fw-bold text-dark small text-uppercase">Username <span class="text-danger">*</span></label>
                                        <input type="text" name="username" 
                                               class="form-control @error('username') is-invalid @enderror"
                                               value="{{ old('username') }}"
                                               placeholder="budi_admin"
                                               required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label fw-bold text-dark small text-uppercase">Password <span class="text-danger">*</span></label>
                                        <input type="password" name="password" 
                                               class="form-control @error('password') is-invalid @enderror"
                                               placeholder="Minimal 6 karakter"
                                               required>
                                    </div>

                                    <div class="mb-0">
                                        <label class="form-label fw-bold text-dark small text-uppercase">Email <span class="text-danger">*</span></label>
                                        <input type="email" name="email" 
                                               class="form-control @error('email') is-invalid @enderror"
                                               value="{{ old('email') }}"
                                               placeholder="budi@example.com"
                                               required>
                                    </div>
                                </div>
                            </div>

                            <!-- Role & Kontak -->
                            <div class="col-md-6">
                                <div class="p-4 rounded-4 bg-light bg-opacity-50 h-100">
                                    <h6 class="fw-bold mb-3 border-bottom pb-2">Akses & Kontak</h6>

                                    <div class="mb-3">
                                        <label class="form-label fw-bold text-dark small text-uppercase">Nomor Telepon <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-white border-end-0">+62</span>
                                            <input type="text" name="nomor_telepon" 
                                                   class="form-control border-start-0 @error('nomor_telepon') is-invalid @enderror"
                                                   value="{{ old('nomor_telepon') }}"
                                                   placeholder="812xxxxxx"
                                                   required>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label fw-bold text-dark small text-uppercase">Jabatan / Role <span class="text-danger">*</span></label>
                                        <select name="role" class="form-select @error('role') is-invalid @enderror" required>
                                            <option value="">Pilih Role</option>
                                            <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin (Full Access)</option>
                                            <option value="kasir" {{ old('role') == 'kasir' ? 'selected' : '' }}>Kasir (Limited Access)</option>
                                        </select>
                                    </div>

                                    <div class="mb-0">
                                        <label class="form-label fw-bold text-dark small text-uppercase">Status Akun <span class="text-danger">*</span></label>
                                        <div class="d-flex gap-3 pt-2">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="status" id="statusAktif" value="aktif" {{ old('status', 'aktif') == 'aktif' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="statusAktif text-success">
                                                    Aktif
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="status" id="statusNonaktif" value="nonaktif" {{ old('status') == 'nonaktif' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="statusNonaktif text-danger">
                                                    Nonaktif
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Tombol Aksi -->
                        <div class="d-flex justify-content-between align-items-center mt-5 pt-4 border-top">
                            <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary px-4">
                                <i class="fas fa-times me-2"></i>Batal
                            </a>
                            <button type="submit" class="btn btn-primary btn-lg px-5 shadow-sm">
                                <i class="fas fa-save me-2"></i>Simpan Staff
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

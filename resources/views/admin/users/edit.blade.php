@extends('layouts.admin')

@section('title', 'Edit Data Staff')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <!-- Header -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="fw-bold mb-1">Edit Profil Staff</h2>
                    <p class="text-muted mb-0">Perbarui informasi akun, role, atau status staff Anda.</p>
                </div>
                <a href="{{ route('admin.users.index') }}" class="btn btn-light border px-4">
                    <i class="fas fa-arrow-left me-2"></i>Kembali
                </a>
            </div>

            <div class="glass-card p-0 overflow-hidden border-0 shadow-lg">
                <div class="card-header bg-white py-3 border-bottom">
                    <h5 class="fw-bold mb-0 text-dark">
                        <i class="fas fa-user-edit me-2 text-warning"></i>Formulir Pembaruan Data
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

                    <form action="{{ route('admin.users.update', $admin->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="row g-4">
                            <!-- Akun Details -->
                            <div class="col-md-6">
                                <div class="p-4 rounded-4 bg-light bg-opacity-50 h-100">
                                    <h6 class="fw-bold mb-3 border-bottom pb-2">Informasi Akun</h6>
                                    
                                    <div class="mb-3">
                                        <label class="form-label fw-bold text-dark small text-uppercase">Nama Lengkap <span class="text-danger">*</span></label>
                                        <input type="text" name="nama_lengkap" 
                                               class="form-control @error('nama_lengkap') is-invalid @enderror"
                                               value="{{ old('nama_lengkap', $admin->name) }}"
                                               required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label fw-bold text-dark small text-uppercase">Username <span class="text-danger">*</span></label>
                                        <input type="text" name="username" 
                                               class="form-control @error('username') is-invalid @enderror"
                                               value="{{ old('username', $admin->username) }}"
                                               required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label fw-bold text-dark small text-uppercase">Email <span class="text-danger">*</span></label>
                                        <input type="email" name="email" 
                                               class="form-control @error('email') is-invalid @enderror"
                                               value="{{ old('email', $admin->email) }}"
                                               required>
                                    </div>

                                    <div class="mb-0">
                                        <label class="form-label fw-bold text-dark small text-uppercase text-primary">Ganti Password (Opsional)</label>
                                        <input type="password" name="password" 
                                               class="form-control @error('password') is-invalid @enderror"
                                               placeholder="Kosongkan jika tidak diubah">
                                        <small class="text-muted mt-1 d-block">Minimal 6 karakter jika ingin mengganti.</small>
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
                                                   value="{{ old('nomor_telepon', $admin->nomor_telepon) }}"
                                                   required>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label fw-bold text-dark small text-uppercase">Jabatan / Role <span class="text-danger">*</span></label>
                                        <select name="role" class="form-select @error('role') is-invalid @enderror" required>
                                            <option value="admin" {{ old('role', $admin->role) == 'admin' ? 'selected' : '' }}>Admin (Full Access)</option>
                                            <option value="kasir" {{ old('role', $admin->role) == 'kasir' ? 'selected' : '' }}>Kasir (Limited Access)</option>
                                        </select>
                                    </div>

                                    <div class="mb-0">
                                        <label class="form-label fw-bold text-dark small text-uppercase">Status Akun <span class="text-danger">*</span></label>
                                        <div class="d-flex gap-3 pt-2">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="status" id="statusAktif" value="aktif" {{ old('status', $admin->status) == 'aktif' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="statusAktif text-success">
                                                    Aktif
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="status" id="statusNonaktif" value="nonaktif" {{ old('status', $admin->status) == 'nonaktif' ? 'checked' : '' }}>
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
                            <div>
                                <a href="{{ route('admin.users.show', $admin->id) }}" class="btn btn-outline-info px-4">
                                    <i class="fas fa-eye me-2"></i>Detail
                                </a>
                                <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary px-4">
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

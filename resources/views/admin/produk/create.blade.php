@extends('layouts.admin')

@section('title', 'Tambah Produk')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <!-- Header -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="fw-bold mb-1 text-dark">Tambah Produk Baru</h2>
                    <p class="text-muted mb-0">Lengkapi data produk untuk menambahkan menu baru ke sistem.</p>
                </div>
                <a href="{{ route('admin.produk.index') }}" class="btn btn-light border px-4">
                    <i class="fas fa-arrow-left me-2"></i>Kembali
                </a>
            </div>

            <div class="glass-card p-0 overflow-hidden border-0 shadow-lg">
                <div class="card-header bg-white py-3 border-bottom">
                    <h5 class="fw-bold mb-0 text-dark"><i class="fas fa-plus-circle me-2 text-primary"></i>Formulir Produk Baru</h5>
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

                    <form action="{{ route('admin.produk.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="row g-4">
                            <!-- Kolom Kiri: Form Data -->
                            <div class="col-md-7">
                                <div class="glass-card p-4 bg-light bg-opacity-50">
                                    <!-- Nama Produk -->
                                    <div class="mb-4">
                                        <label class="form-label fw-bold text-dark small text-uppercase">Nama Produk <span class="text-danger">*</span></label>
                                        <input type="text" name="nama_produk" 
                                               class="form-control form-control-lg @error('nama_produk') is-invalid @enderror"
                                               value="{{ old('nama_produk') }}"
                                               placeholder="Contoh: Pangsit Chili Oil Mayo"
                                               required>
                                        @error('nama_produk')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="row">
                                        <!-- Kategori -->
                                        <div class="col-md-6 mb-4">
                                            <label class="form-label fw-bold text-dark small text-uppercase">Kategori <span class="text-danger">*</span></label>
                                            <select name="kategori_id" class="form-select @error('kategori_id') is-invalid @enderror" required>
                                                <option value="">Pilih Kategori</option>
                                                @foreach($kategoris as $kategori)
                                                    <option value="{{ $kategori->id }}" 
                                                        {{ old('kategori_id') == $kategori->id ? 'selected' : '' }}>
                                                        {{ $kategori->nama_kategori }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('kategori_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Harga -->
                                        <div class="col-md-6 mb-4">
                                            <label class="form-label fw-bold text-dark small text-uppercase">Harga (Rp) <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-white border-end-0">Rp</span>
                                                <input type="number" name="harga" 
                                                       class="form-control border-start-0 @error('harga') is-invalid @enderror"
                                                       value="{{ old('harga') }}"
                                                       min="0" step="100"
                                                       placeholder="0"
                                                       required>
                                            </div>
                                            @error('harga')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row">
                                        <!-- Stok -->
                                        <div class="col-md-6 mb-4">
                                            <label class="form-label fw-bold text-dark small text-uppercase">Stok Awal <span class="text-danger">*</span></label>
                                            <input type="number" name="stok" 
                                                   class="form-control @error('stok') is-invalid @enderror"
                                                   value="{{ old('stok') }}"
                                                   min="0"
                                                   placeholder="0"
                                                   required>
                                            @error('stok')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Status -->
                                        <div class="col-md-6 mb-4">
                                            <label class="form-label fw-bold text-dark small text-uppercase">Status Awal <span class="text-danger">*</span></label>
                                            <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                                                <option value="tersedia" {{ old('status') == 'tersedia' ? 'selected' : '' }}>
                                                    Tersedia
                                                </option>
                                                <option value="habis" {{ old('status') == 'habis' ? 'selected' : '' }}>
                                                    Habis
                                                </option>
                                            </select>
                                            @error('status')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Deskripsi -->
                                    <div class="mb-0">
                                        <label class="form-label fw-bold text-dark small text-uppercase">Deskripsi Produk <span class="text-danger">*</span></label>
                                        <textarea name="deskripsi" rows="5"
                                                  class="form-control @error('deskripsi') is-invalid @enderror"
                                                  placeholder="Jelaskan detail produk Anda di sini..."
                                                  required>{{ old('deskripsi') }}</textarea>
                                        @error('deskripsi')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Kolom Kanan: Gambar -->
                            <div class="col-md-5">
                                <div class="glass-card p-4 border h-100 bg-white">
                                    <label class="form-label fw-bold text-dark small text-uppercase mb-3">Media Produk <span class="text-danger">*</span></label>
                                    
                                    <!-- Preview Container -->
                                    <div class="image-upload-wrapper text-center p-4 rounded-4 border-dashed mb-3" style="border: 2px dashed #dee2e6;">
                                        <div id="imageDisplayArea" class="mb-3">
                                            <div class="py-5 text-muted" id="placeholderIcon">
                                                <i class="fas fa-cloud-upload-alt fa-4x mb-3 opacity-25"></i>
                                                <p class="mb-1 fw-bold">Unggah Gambar</p>
                                                <p class="small opacity-50">Klik tombol di bawah untuk memilih file</p>
                                            </div>
                                            <img id="previewImage" class="img-fluid rounded-4 shadow-sm"
                                                 style="max-height: 250px; width: 100%; object-fit: cover; display: none;">
                                        </div>
                                        
                                        <input type="file" name="gambar" id="imageInput"
                                               class="form-control @error('gambar') is-invalid @enderror"
                                               accept="image/*" style="display: none;" required>
                                        <button type="button" class="btn btn-primary w-100 py-2 shadow-sm" onclick="document.getElementById('imageInput').click()">
                                            <i class="fas fa-image me-2"></i>Pilih Gambar Produk
                                        </button>
                                        @error('gambar')
                                            <div class="invalid-feedback d-block mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    
                                    <div class="alert alert-info py-2 px-3 small border-0 mb-0">
                                        <i class="fas fa-info-circle me-2"></i> <strong>Penting:</strong> Gunakan gambar berkualitas tinggi (min 800x800px) untuk tampilan terbaik di katalog.
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Tombol Aksi -->
                        <div class="d-flex justify-content-between align-items-center mt-5 pt-4 border-top">
                            <a href="{{ route('admin.produk.index') }}" class="btn btn-outline-secondary px-4">
                                <i class="fas fa-times me-2"></i>Batal
                            </a>
                            <button type="submit" class="btn btn-primary btn-lg px-5 shadow-sm">
                                <i class="fas fa-save me-2"></i>Tambah Produk
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const fileInput = document.getElementById('imageInput');
        const previewImage = document.getElementById('previewImage');
        const placeholderIcon = document.getElementById('placeholderIcon');
        
        fileInput.addEventListener('change', function(e) {
            if (this.files && this.files[0]) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                    previewImage.style.display = 'block';
                    if (placeholderIcon) placeholderIcon.style.display = 'none';
                }
                
                reader.readAsDataURL(this.files[0]);
            }
        });
    });
</script>
@endpush
@endsection
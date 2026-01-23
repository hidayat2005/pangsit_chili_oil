@extends('layouts.admin')

@section('title', 'Edit Produk')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <!-- Header -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="fw-bold mb-1 text-dark">Edit Produk</h2>
                    <p class="text-muted mb-0">Perbarui informasi produk <strong>{{ $produk->nama_produk }}</strong></p>
                </div>
                <a href="{{ route('admin.produk.index') }}" class="btn btn-light border px-4">
                    <i class="fas fa-arrow-left me-2"></i>Kembali
                </a>
            </div>

            <div class="glass-card p-0 overflow-hidden border-0 shadow-lg">
                <div class="card-header bg-white py-3 border-bottom">
                    <h5 class="fw-bold mb-0 text-dark"><i class="fas fa-edit me-2 text-warning"></i>Formulir Perubahan</h5>
                </div>
                
                <div class="card-body p-4">
                    <form action="{{ route('admin.produk.update', $produk->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="row g-4">
                            <!-- Kolom Kiri: Form Data -->
                            <div class="col-md-7">
                                <div class="glass-card p-4 bg-light bg-opacity-50">
                                    <!-- Nama Produk -->
                                    <div class="mb-4">
                                        <label class="form-label fw-bold text-dark small text-uppercase">Nama Produk</label>
                                        <input type="text" name="nama_produk" 
                                               class="form-control form-control-lg @error('nama_produk') is-invalid @enderror"
                                               value="{{ old('nama_produk', $produk->nama_produk) }}"
                                               placeholder="Contoh: Pangsit Chili Oil Mayo">
                                        @error('nama_produk')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="row">
                                        <!-- Kategori -->
                                        <div class="col-md-6 mb-4">
                                            <label class="form-label fw-bold text-dark small text-uppercase">Kategori</label>
                                            <select name="kategori_id" class="form-select @error('kategori_id') is-invalid @enderror">
                                                <option value="">Pilih Kategori</option>
                                                @foreach($kategoris as $kategori)
                                                    <option value="{{ $kategori->id }}" 
                                                        {{ old('kategori_id', $produk->kategori_id) == $kategori->id ? 'selected' : '' }}>
                                                        {{ $kategori->nama_kategori }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('kategori_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Status -->
                                        <div class="col-md-6 mb-4">
                                            <label class="form-label fw-bold text-dark small text-uppercase">Status Menu</label>
                                            <select name="status" class="form-select @error('status') is-invalid @enderror">
                                                <option value="tersedia" {{ old('status', $produk->status) == 'tersedia' ? 'selected' : '' }}>
                                                    Tersedia
                                                </option>
                                                <option value="habis" {{ old('status', $produk->status) == 'habis' ? 'selected' : '' }}>
                                                    Habis
                                                </option>
                                            </select>
                                            @error('status')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row">
                                        <!-- Harga -->
                                        <div class="col-md-6 mb-4">
                                            <label class="form-label fw-bold text-dark small text-uppercase">Harga (Rp)</label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-white border-end-0">Rp</span>
                                                <input type="number" name="harga" 
                                                       class="form-control border-start-0 @error('harga') is-invalid @enderror"
                                                       value="{{ old('harga', $produk->harga) }}">
                                            </div>
                                            @error('harga')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Stok -->
                                        <div class="col-md-6 mb-4">
                                            <label class="form-label fw-bold text-dark small text-uppercase">Stok Tersedia</label>
                                            <input type="number" name="stok" 
                                                   class="form-control @error('stok') is-invalid @enderror"
                                                   value="{{ old('stok', $produk->stok) }}">
                                            @error('stok')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Deskripsi -->
                                    <div class="mb-0">
                                        <label class="form-label fw-bold text-dark small text-uppercase">Deskripsi Produk</label>
                                        <textarea name="deskripsi" rows="5"
                                                  class="form-control @error('deskripsi') is-invalid @enderror"
                                                  placeholder="Jelaskan detail produk Anda di sini...">{{ old('deskripsi', $produk->deskripsi) }}</textarea>
                                        @error('deskripsi')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Kolom Kanan: Gambar -->
                            <div class="col-md-5">
                                <div class="glass-card p-4 border h-100 bg-white">
                                    <label class="form-label fw-bold text-dark small text-uppercase mb-3">Media Produk</label>
                                    
                                    <!-- Current and Preview Container -->
                                    <div class="image-upload-wrapper text-center p-3 rounded-4 border-dashed mb-3" style="border: 2px dashed #dee2e6;">
                                        <div id="imageDisplayArea">
                                            @if($produk->gambar)
                                                <img src="{{ asset('storage/' . $produk->gambar) }}" 
                                                     alt="Gambar saat ini" 
                                                     class="img-fluid rounded-4 shadow-sm mb-3"
                                                     id="currentImage"
                                                     style="max-height: 250px; width: 100%; object-fit: cover;">
                                                <div id="newPreviewLabel" style="display: none;" class="badge bg-primary mb-2">Preview Baru</div>
                                            @else
                                                <div class="py-5 text-muted" id="placeholderIcon">
                                                    <i class="fas fa-cloud-upload-alt fa-3x mb-3 opacity-25"></i>
                                                    <p class="mb-0">Belum ada gambar</p>
                                                </div>
                                            @endif
                                            <img id="previewImage" class="img-fluid rounded-4 shadow-sm mb-3"
                                                 style="max-height: 250px; width: 100%; object-fit: cover; display: none;">
                                        </div>
                                        
                                        <input type="file" name="gambar" id="imageInput"
                                               class="form-control @error('gambar') is-invalid @enderror"
                                               accept="image/*" style="display: none;">
                                        <button type="button" class="btn btn-outline-primary w-100 py-2" onclick="document.getElementById('imageInput').click()">
                                            <i class="fas fa-image me-2"></i>Pilih Gambar
                                        </button>
                                        @error('gambar')
                                            <div class="invalid-feedback d-block mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="alert alert-info py-2 px-3 small border-0 mb-0">
                                        <i class="fas fa-info-circle me-2"></i> Format: JPG, PNG, JPEG. Max: 2MB.
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Tombol Aksi -->
                        <div class="d-flex justify-content-between align-items-center mt-5 pt-4 border-top">
                            <a href="{{ route('admin.produk.show', $produk->id) }}" class="btn btn-outline-info px-4">
                                <i class="fas fa-eye me-2"></i>Lihat Detail
                            </a>
                            <button type="submit" class="btn btn-primary btn-lg px-5 shadow-sm">
                                <i class="fas fa-save me-2"></i>Simpan Perubahan
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
        const currentImage = document.getElementById('currentImage');
        const newPreviewLabel = document.getElementById('newPreviewLabel');
        const placeholderIcon = document.getElementById('placeholderIcon');
        
        fileInput.addEventListener('change', function(e) {
            if (this.files && this.files[0]) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                    previewImage.style.display = 'block';
                    if (currentImage) currentImage.style.display = 'none';
                    if (newPreviewLabel) newPreviewLabel.style.display = 'inline-block';
                    if (placeholderIcon) placeholderIcon.style.display = 'none';
                }
                
                reader.readAsDataURL(this.files[0]);
            }
        });
    });
</script>
@endpush
@endsection
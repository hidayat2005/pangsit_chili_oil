@extends('layouts.app')

@section('title', 'Edit Produk')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Edit Produk</h5>
                        <a href="{{ route('admin.produk.index') }}" class="btn btn-outline-secondary btn-sm">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
                
                <div class="card-body">
                    <form action="{{ route('admin.produk.update', $produk->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <!-- Kolom Kiri: Form Data -->
                            <div class="col-md-6">
                                <!-- Nama Produk -->
                                <div class="mb-3">
                                    <label class="form-label">Nama Produk</label>
                                    <input type="text" name="nama_produk" 
                                           class="form-control @error('nama_produk') is-invalid @enderror"
                                           value="{{ old('nama_produk', $produk->nama_produk) }}">
                                    @error('nama_produk')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Kategori -->
                                <div class="mb-3">
                                    <label class="form-label">Kategori</label>
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

                                <!-- Harga -->
                                <div class="mb-3">
                                    <label class="form-label">Harga</label>
                                    <input type="number" name="harga" 
                                           class="form-control @error('harga') is-invalid @enderror"
                                           value="{{ old('harga', $produk->harga) }}">
                                    @error('harga')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Stok -->
                                <div class="mb-3">
                                    <label class="form-label">Stok</label>
                                    <input type="number" name="stok" 
                                           class="form-control @error('stok') is-invalid @enderror"
                                           value="{{ old('stok', $produk->stok) }}">
                                    @error('stok')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Status -->
                                <div class="mb-3">
                                    <label class="form-label">Status</label>
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

                            <!-- Kolom Kanan: Gambar & Deskripsi -->
                            <div class="col-md-6">
                                <!-- Gambar -->
                                <div class="mb-4">
                                    <label class="form-label">Gambar Produk</label>
                                    
                                    <!-- Gambar Saat Ini -->
                                    @if($produk->gambar && Storage::exists('public/' . $produk->gambar))
                                        <div class="mb-3 text-center">
                                            <img src="{{ Storage::url($produk->gambar) }}" 
                                                 alt="Gambar saat ini" 
                                                 class="img-fluid rounded mb-2"
                                                 style="max-height: 200px; object-fit: contain;">
                                            <p class="text-muted mb-0">Gambar saat ini</p>
                                        </div>
                                    @endif

                                    <!-- Input Upload -->
                                    <input type="file" name="gambar" 
                                           class="form-control @error('gambar') is-invalid @enderror"
                                           accept="image/*">
                                    @error('gambar')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">
                                        Kosongkan jika tidak ingin mengganti gambar. Format: JPEG, PNG, JPG (max: 2MB)
                                    </div>

                                    <!-- Preview Gambar Baru -->
                                    <div id="imagePreview" class="mt-3 text-center" style="display: none;">
                                        <img id="previewImage" class="img-fluid rounded mb-2"
                                             style="max-height: 200px; object-fit: contain;">
                                        <p class="text-muted mb-0">Preview gambar baru</p>
                                    </div>
                                </div>

                                <!-- Deskripsi -->
                                <div class="mb-3">
                                    <label class="form-label">Deskripsi</label>
                                    <textarea name="deskripsi" rows="5"
                                              class="form-control @error('deskripsi') is-invalid @enderror">{{ old('deskripsi', $produk->deskripsi) }}</textarea>
                                    @error('deskripsi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Tombol Aksi -->
                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('admin.produk.show', $produk->id) }}" class="btn btn-outline-info">
                                <i class="fas fa-eye me-1"></i> Detail
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i> Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Preview gambar sebelum upload
    document.addEventListener('DOMContentLoaded', function() {
        const fileInput = document.querySelector('input[name="gambar"]');
        const previewContainer = document.getElementById('imagePreview');
        const previewImage = document.getElementById('previewImage');
        
        fileInput.addEventListener('change', function(e) {
            if (this.files && this.files[0]) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                    previewContainer.style.display = 'block';
                }
                
                reader.readAsDataURL(this.files[0]);
            } else {
                previewContainer.style.display = 'none';
            }
        });
    });
</script>
@endsection
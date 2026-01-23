@extends('layouts.admin')

@section('title', 'Tambah Pengeluaran')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card glass-card border-0 p-4">
                <div class="d-flex align-items-center mb-4">
                    <a href="{{ route('admin.pengeluaran.index') }}" class="btn btn-sm btn-light border me-3">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                    <h5 class="fw-bold mb-0">Tambah Pencatatan Pengeluaran</h5>
                </div>

                <form action="{{ route('admin.pengeluaran.store') }}" method="POST">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-12">
                            <label class="form-label small fw-bold">Nama Pengeluaran</label>
                            <input type="text" name="nama_pengeluaran" class="form-control rounded-3" placeholder="Contoh: Bayar Listrik Januari" required>
                        </div>
                        
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Kategori</label>
                            <select name="kategori" class="form-select rounded-3" required>
                                <option value="" disabled selected>Pilih Kategori</option>
                                @foreach($kategoris as $kat)
                                    <option value="{{ $kat }}">{{ $kat }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Jumlah (Rp)</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0 rounded-start-3">Rp</span>
                                <input type="number" name="jumlah" class="form-control rounded-end-3" placeholder="0" required min="0">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Tanggal</label>
                            <input type="date" name="tanggal" class="form-control rounded-3" value="{{ date('Y-m-d') }}" required>
                        </div>

                        <div class="col-md-12">
                            <label class="form-label small fw-bold">Keterangan (Opsional)</label>
                            <textarea name="keterangan" class="form-control rounded-3" rows="3" placeholder="Tambahkan rincian jika perlu..."></textarea>
                        </div>

                        <div class="col-md-12 mt-4 pt-2 border-top">
                            <div class="d-flex gap-2 justify-content-end">
                                <a href="{{ route('admin.pengeluaran.index') }}" class="btn btn-light px-4">Batal</a>
                                <button type="submit" class="btn btn-primary px-5">Simpan Data</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.admin')

@section('title', 'Edit Pengeluaran')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card glass-card border-0 p-4">
                <div class="d-flex align-items-center mb-4">
                    <a href="{{ route('admin.pengeluaran.index') }}" class="btn btn-sm btn-light border me-3">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                    <h5 class="fw-bold mb-0">Edit Pencatatan Pengeluaran</h5>
                </div>

                <form action="{{ route('admin.pengeluaran.update', $pengeluaran->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row g-3">
                        <div class="col-md-12">
                            <label class="form-label small fw-bold">Nama Pengeluaran</label>
                            <input type="text" name="nama_pengeluaran" class="form-control rounded-3" value="{{ $pengeluaran->nama_pengeluaran }}" required>
                        </div>
                        
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Kategori</label>
                            <select name="kategori" class="form-select rounded-3" required>
                                @foreach($kategoris as $kat)
                                    <option value="{{ $kat }}" {{ $pengeluaran->kategori == $kat ? 'selected' : '' }}>{{ $kat }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Jumlah (Rp)</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0 rounded-start-3">Rp</span>
                                <input type="number" name="jumlah" class="form-control rounded-end-3" value="{{ intval($pengeluaran->jumlah) }}" required min="0">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Tanggal</label>
                            <input type="date" name="tanggal" class="form-control rounded-3" value="{{ $pengeluaran->tanggal->format('Y-m-d') }}" required>
                        </div>

                        <div class="col-md-12">
                            <label class="form-label small fw-bold">Keterangan (Opsional)</label>
                            <textarea name="keterangan" class="form-control rounded-3" rows="3">{{ $pengeluaran->keterangan }}</textarea>
                        </div>

                        <div class="col-md-12 mt-4 pt-2 border-top">
                            <div class="d-flex gap-2 justify-content-end">
                                <a href="{{ route('admin.pengeluaran.index') }}" class="btn btn-light px-4">Batal</a>
                                <button type="submit" class="btn btn-primary px-5">Simpan Perubahan</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

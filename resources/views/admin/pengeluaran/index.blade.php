@extends('layouts.admin')

@section('title', 'Manajemen Pengeluaran')

@section('content')
    <div class="row g-4">
        <!-- Statistik & Filter -->
        <div class="col-12">
            <div class="glass-card p-4">
                <div class="row align-items-center g-3">
                    <div class="col-lg-4">
                        <div class="d-flex align-items-center">
                            <div class="bg-primary bg-opacity-10 p-3 rounded-4 me-3">
                                <i class="fas fa-wallet fs-3 text-primary"></i>
                            </div>
                            <div>
                                <h6 class="text-muted mb-1 small text-uppercase fw-bold">Total Pengeluaran Periode Ini</h6>
                                <h3 class="fw-bold mb-0 text-dark">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <form action="{{ route('admin.pengeluaran.index') }}" method="GET" class="row g-2 justify-content-lg-end">
                            <div class="col-md-3">
                                <input type="date" name="start_date" class="form-control form-control-sm border-0 bg-light rounded-3" value="{{ $startDate->format('Y-m-d') }}">
                            </div>
                            <div class="col-md-3">
                                <input type="date" name="end_date" class="form-control form-control-sm border-0 bg-light rounded-3" value="{{ $endDate->format('Y-m-d') }}">
                            </div>
                            <div class="col-md-3">
                                <select name="kategori" class="form-select form-select-sm border-0 bg-light rounded-3">
                                    <option value="">Semua Kategori</option>
                                    @foreach($kategoris as $kat)
                                        <option value="{{ $kat }}" {{ request('kategori') == $kat ? 'selected' : '' }}>{{ $kat }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary btn-sm w-100 rounded-3">
                                    <i class="fas fa-filter"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabel Data -->
        <div class="col-12">
            <div class="table-card p-0 shadow-sm">
                <div class="card-header bg-white py-3 px-4 border-bottom d-flex justify-content-between align-items-center">
                    <h5 class="fw-bold mb-0">Daftar Pengeluaran Operasional</h5>
                    <a href="{{ route('admin.pengeluaran.create') }}" class="btn btn-primary btn-sm rounded-pill px-4">
                        <i class="fas fa-plus me-2"></i>Tambah Pengeluaran
                    </a>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th class="text-center" width="60">No</th>
                                <th>Tanggal</th>
                                <th>Nama Pengeluaran</th>
                                <th>Kategori</th>
                                <th class="text-end">Jumlah</th>
                                <th class="text-center" width="150">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pengeluarans as $index => $item)
                            <tr>
                                <td class="text-center text-muted small">{{ $pengeluarans->firstItem() + $index }}</td>
                                <td>{{ $item->tanggal->format('d M Y') }}</td>
                                <td>
                                    <div class="fw-bold text-dark">{{ $item->nama_pengeluaran }}</div>
                                    <small class="text-muted">{{ Str::limit($item->keterangan, 50) ?: '-' }}</small>
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark border px-2 py-1 small">{{ $item->kategori }}</span>
                                </td>
                                <td class="text-end fw-bold text-danger">Rp {{ number_format($item->jumlah, 0, ',', '.') }}</td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('admin.pengeluaran.edit', $item->id) }}" class="btn btn-sm btn-light border" title="Edit">
                                            <i class="fas fa-edit text-primary"></i>
                                        </a>
                                        <form action="{{ route('admin.pengeluaran.destroy', $item->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-light border" title="Hapus">
                                                <i class="fas fa-trash text-danger"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center py-5">
                                    <div class="mb-3 opacity-25">
                                        <i class="fas fa-receipt fa-4x text-muted"></i>
                                    </div>
                                    <h5 class="text-muted">Belum ada data pengeluaran.</h5>
                                    <p class="text-muted small">Klik "Tambah Pengeluaran" untuk mulai mencatat pengeluaran operasional Anda.</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if($pengeluarans->hasPages())
                <div class="card-footer bg-white py-3 border-top">
                    {{ $pengeluarans->withQueryString()->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>
@endsection

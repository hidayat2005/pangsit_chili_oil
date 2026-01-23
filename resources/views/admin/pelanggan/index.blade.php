@extends('layouts.admin')

@section('title', 'Manajemen Pelanggan')

@section('content')
    <!-- Header -->
    <div class="row mb-4">
        <div class="col">
            <div class="glass-card p-4 d-flex justify-content-between align-items-center flex-wrap gap-3">
                <div>
                    <h2 class="fw-bold mb-1">Daftar Pelanggan</h2>
                    <p class="text-muted mb-0">Kelola dan pantau basis pelanggan Pangsit Chili Oil Anda.</p>
                </div>
                <div class="badge bg-primary px-3 py-2 rounded-pill">
                    <i class="fas fa-users me-2"></i> {{ $pelanggans->total() }} Pelanggan Terdaftar
                </div>
            </div>
        </div>
    </div>

    <!-- Statistik Pelanggan -->
    <div class="row g-4 mb-4">
        <div class="col-xl-4 col-md-6">
            <div class="card h-100" style="border-left: 5px solid #3b82f6 !important;">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="rounded-circle d-flex align-items-center justify-content-center" 
                             style="width: 50px; height: 50px; background: rgba(59, 130, 246, 0.1); color: #3b82f6;">
                            <i class="fas fa-users fs-4"></i>
                        </div>
                    </div>
                    <div>
                        <h6 class="text-muted fw-bold text-uppercase mb-1" style="font-size: 0.75rem; letter-spacing: 0.05em;">Total Pelanggan</h6>
                        <h2 class="fw-bold mb-0 text-dark">{{ $totalPelanggan }}</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6">
            <div class="card h-100" style="border-left: 5px solid #10b981 !important;">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="rounded-circle d-flex align-items-center justify-content-center" 
                             style="width: 50px; height: 50px; background: rgba(16, 185, 129, 0.1); color: #10b981;">
                            <i class="fas fa-user-check fs-4"></i>
                        </div>
                    </div>
                    <div>
                        <h6 class="text-muted fw-bold text-uppercase mb-1" style="font-size: 0.75rem; letter-spacing: 0.05em;">Pelanggan Aktif</h6>
                        <h2 class="fw-bold mb-0 text-dark">{{ $pelangganAktif }}</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-12">
            <div class="card h-100" style="border-left: 5px solid #8b5cf6 !important;">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="rounded-circle d-flex align-items-center justify-content-center" 
                             style="width: 50px; height: 50px; background: rgba(139, 92, 246, 0.1); color: #8b5cf6;">
                            <i class="fas fa-shopping-cart fs-4"></i>
                        </div>
                    </div>
                    <div>
                        <h6 class="text-muted fw-bold text-uppercase mb-1" style="font-size: 0.75rem; letter-spacing: 0.05em;">Total Pesanan</h6>
                        <h2 class="fw-bold mb-0 text-dark">{{ $totalPesanan ?? 0 }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="row">
        <div class="col-12">
            <div class="table-card p-0">
                <div class="card-header bg-white py-4 px-4 border-bottom">
                    <h5 class="fw-bold mb-0">Daftar Akun Pelanggan</h5>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th class="text-center" width="80">ID</th>
                                <th>Nama Pelanggan</th>
                                <th>Contact details</th>
                                <th class="text-center" width="150">Status Akun</th>
                                <th class="text-center" width="100">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pelanggans as $pelanggan)
                            <tr>
                                <td class="text-center align-middle">
                                    <span class="badge bg-light text-muted border px-2 py-1">#{{ $pelanggan->id }}</span>
                                </td>
                                <td class="align-middle">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="user-avatar text-uppercase bg-light text-success fw-bold" style="width: 38px; height: 38px;">
                                            {{ substr($pelanggan->nama_pelanggan, 0, 1) }}
                                        </div>
                                        <div>
                                            <div class="fw-bold text-dark">{{ $pelanggan->nama_pelanggan }}</div>
                                            @if($pelanggan->alamat)
                                                <small class="text-muted"><i class="fas fa-map-marker-alt me-1"></i> {{ Str::limit($pelanggan->alamat, 40) }}</small>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle">
                                    <div class="small fw-bold"><i class="fas fa-envelope text-muted me-2"></i>{{ $pelanggan->email ?? '-' }}</div>
                                    <div class="small"><i class="fas fa-phone-alt text-muted me-2"></i>{{ $pelanggan->nomor_telepon }}</div>
                                </td>
                                <td class="text-center align-middle">
                                    @if($pelanggan->user)
                                        <div class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 px-3 py-2">
                                            <i class="fas fa-check-circle me-1"></i> Aktif
                                        </div>
                                    @else
                                        <div class="badge bg-warning bg-opacity-10 text-warning border border-warning border-opacity-25 px-3 py-2">
                                            <i class="fas fa-clock me-1"></i> Non-Aktif
                                        </div>
                                    @endif
                                </td>
                                <td class="text-center align-middle">
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('admin.pelanggan.show', $pelanggan->id) }}" class="btn btn-sm btn-light border" title="Detail">
                                            <i class="fas fa-eye text-primary"></i>
                                        </a>
                                        <form action="{{ route('admin.pelanggan.destroy', $pelanggan->id) }}" method="POST" class="d-inline">
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
                                <td colspan="5" class="text-center py-5">
                                    <div class="mb-3"><i class="fas fa-user-friends fa-4x text-muted opacity-25"></i></div>
                                    <h5 class="text-muted">Database pelanggan masih kosong.</h5>
                                    <p class="text-muted small">Pelanggan akan muncul setelah mereka mendaftarkan akun.</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($pelanggans->hasPages())
                <div class="px-4 py-3 border-top">
                    <div class="d-flex justify-content-between align-items-center flex-wrap">
                        <small class="text-muted">Menampilkan {{ $pelanggans->firstItem() }}-{{ $pelanggans->lastItem() }} dari {{ $pelanggans->total() }} pelanggan</small>
                        {{ $pelanggans->links() }}
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
@endsection
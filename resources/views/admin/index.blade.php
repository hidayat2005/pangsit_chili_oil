@extends('layouts.admin')

@section('title', 'Manajemen Admin/Kasir')

@section('content')
    <!-- Header -->
    <div class="row mb-4">
        <div class="col">
            <div class="glass-card p-4 d-flex justify-content-between align-items-center flex-wrap gap-3">
                <div>
                    <h2 class="fw-bold mb-1">Manajemen Admin & Kasir</h2>
                    <p class="text-muted mb-0">Kelola hak akses dan data staff Pangsit Chili Oil Anda.</p>
                </div>
                <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i>Tambah Staff Baru
                </a>
            </div>
        </div>
    </div>

    <!-- Statistik -->
    <div class="row g-4 mb-4">
        <div class="col-xl-3 col-md-6">
            <div class="card h-100" style="border-left: 5px solid #ef4444 !important;">
                <div class="card-body p-4 text-center">
                    <div class="rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" 
                         style="width: 50px; height: 50px; background: rgba(239, 68, 68, 0.1); color: #ef4444;">
                        <i class="fas fa-user-shield fs-4"></i>
                    </div>
                    <h6 class="text-muted fw-bold text-uppercase mb-1" style="font-size: 0.7rem;">Admin</h6>
                    <h3 class="fw-bold mb-0">{{ $admins->where('role', 'admin')->count() }}</h3>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card h-100" style="border-left: 5px solid #06b6d4 !important;">
                <div class="card-body p-4 text-center">
                    <div class="rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" 
                         style="width: 50px; height: 50px; background: rgba(6, 182, 212, 0.1); color: #06b6d4;">
                        <i class="fas fa-cash-register fs-4"></i>
                    </div>
                    <h6 class="text-muted fw-bold text-uppercase mb-1" style="font-size: 0.7rem;">Kasir</h6>
                    <h3 class="fw-bold mb-0">{{ $admins->where('role', 'kasir')->count() }}</h3>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card h-100" style="border-left: 5px solid #10b981 !important;">
                <div class="card-body p-4 text-center">
                    <div class="rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" 
                         style="width: 50px; height: 50px; background: rgba(16, 185, 129, 0.1); color: #10b981;">
                        <i class="fas fa-check-circle fs-4"></i>
                    </div>
                    <h6 class="text-muted fw-bold text-uppercase mb-1" style="font-size: 0.7rem;">Aktif</h6>
                    <h3 class="fw-bold mb-0">{{ $admins->where('status', 'aktif')->count() }}</h3>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card h-100" style="border-left: 5px solid #f59e0b !important;">
                <div class="card-body p-4 text-center">
                    <div class="rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" 
                         style="width: 50px; height: 50px; background: rgba(245, 158, 11, 0.1); color: #f59e0b;">
                        <i class="fas fa-user-slash fs-4"></i>
                    </div>
                    <h6 class="text-muted fw-bold text-uppercase mb-1" style="font-size: 0.7rem;">Nonaktif</h6>
                    <h3 class="fw-bold mb-0">{{ $admins->where('status', 'nonaktif')->count() }}</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="row">
        <div class="col-12">
            <div class="table-card p-0">
                <div class="card-header bg-white py-4 px-4 border-bottom d-flex align-items-center justify-content-between flex-wrap gap-2">
                    <h5 class="fw-bold mb-0 text-dark">Daftar Staff</h5>
                    <div class="badge bg-light text-dark px-3 py-2 border">Total: {{ $admins->count() }} Orang</div>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th class="text-center" width="60">No</th>
                                <th>Nama Staff</th>
                                <th>Account Details</th>
                                <th class="text-center" width="120">Role</th>
                                <th class="text-center" width="120">Status</th>
                                <th class="text-center" width="150">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $startNumber = 1;
                                if ($admins instanceof \Illuminate\Pagination\LengthAwarePaginator) {
                                    $startNumber = ($admins->currentPage() - 1) * $admins->perPage() + 1;
                                }
                            @endphp
                            
                            @forelse($admins as $index => $admin)
                            <tr>
                                <td class="text-center fw-bold text-muted">
                                    {{ $startNumber + $index }}
                                </td>
                                <td>
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="user-avatar text-uppercase bg-light text-primary fw-bold" style="width: 38px; height: 38px;">
                                            {{ substr($admin->nama_lengkap, 0, 1) }}
                                        </div>
                                        <div>
                                            <div class="fw-bold">{{ $admin->nama_lengkap }}</div>
                                            <small class="text-muted"><i class="fas fa-phone-alt me-1"></i> {{ $admin->nomor_telepon }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="small fw-bold">@ {{ $admin->username }}</div>
                                    <div class="small text-muted">{{ $admin->email }}</div>
                                </td>
                                <td class="text-center">
                                    @if($admin->role == 'admin')
                                        <span class="badge bg-danger rounded-pill px-3">Admin</span>
                                    @else
                                        <span class="badge bg-info text-dark rounded-pill px-3">Kasir</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if($admin->status == 'aktif')
                                        <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 px-3">Aktif</span>
                                    @else
                                        <span class="badge bg-danger bg-opacity-10 text-danger border border-danger border-opacity-25 px-3">Nonaktif</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('admin.users.edit', $admin->id) }}" class="btn btn-sm btn-light border" title="Edit">
                                            <i class="fas fa-edit text-warning"></i>
                                        </a>
                                        <form action="{{ route('admin.users.destroy', $admin->id) }}" method="POST" class="d-inline">
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
                                    <div class="mb-3"><i class="fas fa-users-slash fa-4x text-muted opacity-25"></i></div>
                                    <h5 class="text-muted">Oops! Belum ada staff.</h5>
                                    <a href="{{ route('admin.users.create') }}" class="btn btn-primary mt-3">Tambah Staff Pertama</a>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($admins instanceof \Illuminate\Pagination\LengthAwarePaginator && $admins->hasPages())
                <div class="px-4 py-3 border-top">
                    <div class="d-flex justify-content-between align-items-center flex-wrap">
                        <small class="text-muted">Menampilkan {{ $admins->firstItem() }}-{{ $admins->lastItem() }} dari {{ $admins->total() }} staff</small>
                        {{ $admins->links() }}
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
@endsection
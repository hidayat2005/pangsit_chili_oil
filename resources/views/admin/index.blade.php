@extends('layouts.app')

@section('title', 'Manajemen Admin/Kasir')

@section('content')
    <!-- Header -->
    <div class="row mb-4">
        <div class="col">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h3 class="mb-1">Daftar Admin/Kasir</h3>
                    <p class="text-muted mb-0">Kelola data admin dan kasir Pangsit Chili Oil</p>
                </div>
                <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-1"></i>Tambah Admin/Kasir
                </a>
            </div>
        </div>
    </div>

    <!-- Statistik -->
    <div class="row mb-4">
        <div class="col-md-3 mb-3">
            <div class="card bg-danger text-white h-100">
                <div class="card-body d-flex flex-column justify-content-between">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h6 class="mb-2">Total Admin</h6>
                            <h2 class="mb-0">{{ $admins->where('role', 'admin')->count() }}</h2>
                        </div>
                        <i class="fas fa-user-shield fa-2x opacity-75"></i>
                    </div>
                    <small class="opacity-75 mt-2">
                        Admin sistem
                    </small>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card bg-info text-white h-100">
                <div class="card-body d-flex flex-column justify-content-between">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h6 class="mb-2">Total Kasir</h6>
                            <h2 class="mb-0">{{ $admins->where('role', 'kasir')->count() }}</h2>
                        </div>
                        <i class="fas fa-cash-register fa-2x opacity-75"></i>
                    </div>
                    <small class="opacity-75 mt-2">
                        Kasir aktif
                    </small>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card bg-success text-white h-100">
                <div class="card-body d-flex flex-column justify-content-between">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h6 class="mb-2">Aktif</h6>
                            <h2 class="mb-0">{{ $admins->where('status', 'aktif')->count() }}</h2>
                        </div>
                        <i class="fas fa-check-circle fa-2x opacity-75"></i>
                    </div>
                    <small class="opacity-75 mt-2">
                        Pengguna aktif
                    </small>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card bg-warning text-white h-100">
                <div class="card-body d-flex flex-column justify-content-between">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h6 class="mb-2">Nonaktif</h6>
                            <h2 class="mb-0">{{ $admins->where('status', 'nonaktif')->count() }}</h2>
                        </div>
                        <i class="fas fa-user-slash fa-2x opacity-75"></i>
                    </div>
                    <small class="opacity-75 mt-2">
                        Pengguna nonaktif
                    </small>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="row">
        <div class="col-12">
            <!-- Admin Table Card -->
            <div class="card shadow-sm border-0">
                <!-- Card Header -->
                <div class="card-header bg-white py-3 border-bottom">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <h5 class="mb-0">Semua Admin/Kasir</h5>
                        </div>
                        <div class="col-md-6 text-md-end">
                            <span class="text-muted">
                                Total: <strong>{{ $admins->count() }}</strong> orang
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Card Body -->
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="py-3 px-4" width="50">No</th>
                                    <th class="py-3 px-4">Nama Lengkap</th>
                                    <th class="py-3 px-4" width="120">Username</th>
                                    <th class="py-3 px-4" width="150">Email</th>
                                    <th class="py-3 px-4" width="100">Role</th>
                                    <th class="py-3 px-4" width="100">Status</th>
                                    <th class="py-3 px-4 text-center" width="140">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    // Hitung nomor urut berdasarkan pagination atau collection
                                    $startNumber = 1;
                                    if ($admins instanceof \Illuminate\Pagination\LengthAwarePaginator) {
                                        $startNumber = ($admins->currentPage() - 1) * $admins->perPage() + 1;
                                    }
                                @endphp
                                
                                @forelse($admins as $index => $admin)
                                <tr>
                                    <td class="px-4 py-3 align-middle">
                                        {{ $startNumber + $index }}
                                    </td>
                                    <td class="px-4 py-3 align-middle">
                                        <div>
                                            <strong class="d-block mb-1">{{ $admin->nama_lengkap }}</strong>
                                            <small class="text-muted">{{ $admin->nomor_telepon }}</small>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 align-middle">
                                        <code>{{ $admin->username }}</code>
                                    </td>
                                    <td class="px-4 py-3 align-middle">
                                        <small>{{ $admin->email }}</small>
                                    </td>
                                    <td class="px-4 py-3 align-middle">
                                        @if($admin->role == 'admin')
                                            <span class="badge bg-danger">Admin</span>
                                        @else
                                            <span class="badge bg-info">Kasir</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 align-middle">
                                        @if($admin->status == 'aktif')
                                            <span class="badge bg-success">Aktif</span>
                                        @else
                                            <span class="badge bg-danger">Nonaktif</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 align-middle text-center">
                                        <div class="btn-group btn-group-sm">
                                            <a href="{{ route('admin.users.show', $admin->id) }}" 
                                               class="btn btn-outline-info px-3" 
                                               title="Detail">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.users.edit', $admin->id) }}" 
                                               class="btn btn-outline-warning px-3" 
                                               title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.users.destroy', $admin->id) }}" method="POST" 
                                                  class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="btn btn-outline-danger px-3" 
                                                        title="Hapus">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center py-5">
                                        <div class="py-4">
                                            <i class="fas fa-users fa-3x text-muted mb-3"></i>
                                            <h5 class="text-muted">Belum ada admin/kasir</h5>
                                            <p class="text-muted mb-4">Mulai dengan menambahkan admin pertama</p>
                                            <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
                                                <i class="fas fa-plus me-2"></i>Tambah Admin
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination - Hanya tampilkan jika $admins adalah Paginator -->
                    @if($admins instanceof \Illuminate\Pagination\LengthAwarePaginator && $admins->hasPages())
                    <div class="card-footer bg-white border-top py-3">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <div class="text-muted">
                                    Menampilkan {{ $admins->firstItem() }} sampai {{ $admins->lastItem() }} 
                                    dari {{ $admins->total() }} admin/kasir
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex justify-content-md-end">
                                    {{ $admins->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

<script>
    // Script sederhana untuk konfirmasi hapus
    document.addEventListener('DOMContentLoaded', function() {
        const deleteForms = document.querySelectorAll('form[action*="destroy"]');
        deleteForms.forEach(form => {
            form.addEventListener('submit', function(e) {
                if (!confirm('Apakah Anda yakin ingin menghapus admin ini?')) {
                    e.preventDefault();
                }
            });
        });
    });
</script>
@endsection
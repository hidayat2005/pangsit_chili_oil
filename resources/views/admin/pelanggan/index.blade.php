@extends('layouts.app')

@section('title', 'Manajemen Pelanggan')

@section('content')
    <!-- Header -->
    <div class="row mb-4">
        <div class="col">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h3 class="mb-1">Daftar Pelanggan</h3>
                    <p class="text-muted mb-0">Kelola data pelanggan Pangsit Chili Oil</p>
                </div>
                <!-- TIDAK ADA tombol Tambah Pelanggan karena pelanggan isi sendiri -->
            </div>
        </div>
    </div>

    <!-- Statistik Pelanggan -->
    <div class="row mb-4">
        <div class="col-md-4 mb-3">
            <div class="card bg-primary text-white h-100">
                <div class="card-body d-flex flex-column justify-content-between">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h6 class="mb-2">Total Pelanggan</h6>
                            <h2 class="mb-0">{{ $totalPelanggan }}</h2>
                        </div>
                        <i class="fas fa-users fa-2x opacity-75"></i>
                    </div>
                    <small class="opacity-75 mt-2">
                        Jumlah semua pelanggan
                    </small>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card bg-success text-white h-100">
                <div class="card-body d-flex flex-column justify-content-between">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h6 class="mb-2">Pelanggan Aktif</h6>
                            <h2 class="mb-0">{{ $pelangganAktif }}</h2>
                        </div>
                        <i class="fas fa-user-check fa-2x opacity-75"></i>
                    </div>
                    <small class="opacity-75 mt-2">
                        Memiliki akun aktif
                    </small>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card bg-info text-white h-100">
                <div class="card-body d-flex flex-column justify-content-between">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h6 class="mb-2">Total Pesanan</h6>
                            <h2 class="mb-0">{{ $totalPesanan ?? 0 }}</h2>
                        </div>
                        <i class="fas fa-shopping-cart fa-2x opacity-75"></i>
                    </div>
                    <small class="opacity-75 mt-2">
                        Total semua pesanan
                    </small>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="row">
        <div class="col-12">
            <!-- Pelanggan Table Card -->
            <div class="card shadow-sm border-0">
                <!-- Card Header -->
                <div class="card-header bg-white py-3 border-bottom">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <h5 class="mb-0">Semua Pelanggan</h5>
                        </div>
                        <div class="col-md-6 text-md-end">
                            <span class="text-muted">
                                Total: <strong>{{ $pelanggans->total() }}</strong> pelanggan
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
                                    <th class="py-3 px-4" width="60">ID</th>
                                    <th class="py-3 px-4">Nama Pelanggan</th>
                                    <th class="py-3 px-4" width="180">Email</th>
                                    <th class="py-3 px-4" width="130">Telepon</th>
                                    <th class="py-3 px-4" width="120">Status Akun</th>
                                    <th class="py-3 px-4 text-center" width="120">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($pelanggans as $pelanggan)
                                <tr>
                                    <td class="px-4 py-3 align-middle">
                                        <strong>#{{ $pelanggan->id }}</strong>
                                    </td>
                                    <td class="px-4 py-3 align-middle">
                                        <div>
                                            <strong class="d-block mb-1">{{ $pelanggan->nama_pelanggan }}</strong>
                                            @if($pelanggan->alamat)
                                                <small class="text-muted">{{ Str::limit($pelanggan->alamat, 40) }}</small>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 align-middle">
                                        <div class="d-flex align-items-center">
                                            @if($pelanggan->email)
                                                <i class="fas fa-envelope text-muted me-2"></i>
                                                <span>{{ $pelanggan->email }}</span>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 align-middle">
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-phone text-muted me-2"></i>
                                            <span>{{ $pelanggan->nomor_telepon }}</span>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 align-middle">
                                        @if($pelanggan->user)
                                            <span class="badge bg-success d-flex align-items-center" style="width: fit-content;">
                                                <i class="fas fa-user-check me-1"></i>
                                                Aktif
                                            </span>
                                            <small class="text-muted d-block mt-1">
                                                {{ $pelanggan->user->email ?? '' }}
                                            </small>
                                        @else
                                            <span class="badge bg-warning d-flex align-items-center" style="width: fit-content;">
                                                <i class="fas fa-user-times me-1"></i>
                                                Non-Aktif
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 align-middle text-center">
                                        <div class="btn-group btn-group-sm">
                                            <a href="{{ route('admin.pelanggan.show', $pelanggan->id) }}" 
                                               class="btn btn-outline-info px-3" 
                                               title="Detail">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <!-- TIDAK ADA tombol EDIT karena pelanggan isi sendiri -->
                                            <form action="{{ route('admin.pelanggan.destroy', $pelanggan->id) }}" method="POST" 
                                                  class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="btn btn-outline-danger px-3" 
                                                        title="Hapus"
                                                        onclick="return confirm('Hapus pelanggan ini?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center py-5">
                                        <div class="py-4">
                                            <i class="fas fa-users fa-3x text-muted mb-3"></i>
                                            <h5 class="text-muted">Belum ada pelanggan</h5>
                                            <p class="text-muted mb-4">Pelanggan akan muncul setelah mengisi profil</p>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if($pelanggans->hasPages())
                    <div class="card-footer bg-white border-top py-3">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <div class="text-muted">
                                    Menampilkan {{ $pelanggans->firstItem() ?? 0 }} sampai {{ $pelanggans->lastItem() ?? 0 }} 
                                    dari {{ $pelanggans->total() }} pelanggan
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex justify-content-md-end">
                                    {{ $pelanggans->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Konfirmasi hapus
        const deleteForms = document.querySelectorAll('form[action*="destroy"]');
        deleteForms.forEach(form => {
            form.addEventListener('submit', function(e) {
                if (!confirm('Apakah Anda yakin ingin menghapus pelanggan ini?')) {
                    e.preventDefault();
                }
            });
        });
    });
</script>
@endsection
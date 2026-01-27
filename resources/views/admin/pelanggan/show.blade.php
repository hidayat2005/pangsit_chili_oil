@extends('layouts.admin')

@section('title', 'Detail Pelanggan')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <!-- Header -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="fw-bold mb-1">Profil Pelanggan</h2>
                    <p class="text-muted mb-0">Informasi lengkap dan riwayat aktivitas pelanggan.</p>
                </div>
                <a href="{{ route('admin.pelanggan.index') }}" class="btn btn-light border px-4">
                    <i class="fas fa-arrow-left me-2"></i>Kembali
                </a>
            </div>

            <div class="row g-4">
                <!-- Info Utama -->
                <div class="col-md-5">
                    <div class="glass-card p-0 overflow-hidden border-0 shadow-lg h-100">
                        <div class="card-header bg-white py-3 border-bottom">
                            <h5 class="fw-bold mb-0 text-dark"><i class="fas fa-info-circle me-2 text-primary"></i>Data Pribadi</h5>
                        </div>
                        <div class="card-body p-4">
                            <div class="text-center mb-4 pb-3 border-bottom">
                                <div class="user-avatar text-uppercase bg-primary text-white fw-bold mx-auto mb-3" style="width: 80px; height: 80px; font-size: 2rem;">
                                    {{ substr($pelanggan->nama_pelanggan, 0, 1) }}
                                </div>
                                <h4 class="fw-bold mb-1">{{ $pelanggan->nama_pelanggan }}</h4>
                                <span class="badge {{ $pelanggan->user ? 'bg-success' : 'bg-warning' }} rounded-pill px-3">
                                    {{ $pelanggan->user ? 'Akun Aktif' : 'Non-Aktif' }}
                                </span>
                            </div>

                            <div class="mb-3">
                                <label class="text-muted small text-uppercase fw-bold d-block mb-1">Email</label>
                                <p class="text-dark mb-0 fw-semibold">{{ $pelanggan->email ?? '-' }}</p>
                            </div>
                            <div class="mb-3">
                                <label class="text-muted small text-uppercase fw-bold d-block mb-1">Nomor Telepon</label>
                                <p class="text-dark mb-0 fw-semibold">{{ $pelanggan->nomor_telepon }}</p>
                            </div>
                            <div class="mb-3">
                                <label class="text-muted small text-uppercase fw-bold d-block mb-1">Alamat Lengkap</label>
                                <p class="text-dark mb-0 small">{{ $pelanggan->alamat }}</p>
                            </div>
                            <div class="mb-0">
                                <label class="text-muted small text-uppercase fw-bold d-block mb-1">Bergabung Sejak</label>
                                <p class="text-dark mb-0 small">{{ $pelanggan->created_at->format('d F Y') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Info Akun & Statistik -->
                <div class="col-md-7">
                    <div class="row g-4 h-100">
                        @if($pelanggan->user)
                        <div class="col-12">
                            <div class="glass-card p-4 border-0">
                                <h6 class="fw-bold mb-3 text-dark border-bottom pb-2">
                                    <i class="fas fa-user-lock me-2 text-warning"></i>Informasi Akun (Login)
                                </h6>
                                <div class="row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <label class="text-muted small text-uppercase fw-bold d-block mb-1">Username</label>
                                        <p class="text-dark mb-0 fw-bold">@ {{ $pelanggan->user->name }}</p>
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="text-muted small text-uppercase fw-bold d-block mb-1">Email Login</label>
                                        <p class="text-dark mb-0 small">{{ $pelanggan->user->email }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif

                        <div class="col-12">
                            <div class="glass-card p-4 border-0 h-100">
                                <h6 class="fw-bold mb-3 text-dark border-bottom pb-2">
                                    <i class="fas fa-history me-2 text-success"></i>Riwayat Pesanan
                                </h6>
                                
                                @if($pelanggan->pesanan && $pelanggan->pesanan->count() > 0)
                                    <div class="table-responsive">
                                        <table class="table table-sm table-hover mb-0">
                                            <thead>
                                                <tr>
                                                    <th>No. Pesanan</th>
                                                    <th>Tanggal</th>
                                                    <th>Total</th>
                                                    <th class="text-center">Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($pelanggan->pesanan as $pesanan)
                                                <tr>
                                                    <td class="fw-bold text-primary small">#{{ $pesanan->id }}</td>
                                                    <td class="small">{{ $pesanan->created_at->format('d/m/y') }}</td>
                                                    <td class="small fw-bold">Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</td>
                                                    <td class="text-center">
                                                        <span class="badge bg-{{ $pesanan->status_pesanan == 'selesai' ? 'success' : 'warning' }} px-2" style="font-size: 0.7rem;">
                                                            {{ ucfirst($pesanan->status_pesanan ?? 'Menunggu') }}
                                                        </span>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                    <div class="text-center py-4">
                                        <i class="fas fa-shopping-bag fa-3x text-muted opacity-25 mb-3"></i>
                                        <p class="text-muted mb-0">Belum ada riwayat pesanan.</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer Actions -->
            <div class="glass-card mt-4 p-3 border-0">
                <div class="d-flex justify-content-between align-items-center">
                    <span class="text-muted small font-italic">Update terakhir: {{ $pelanggan->updated_at->diffForHumans() }}</span>
                    <form action="{{ route('admin.pelanggan.destroy', $pelanggan->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger px-4" onclick="return confirm('Hapus seluruh data pelanggan ini?')">
                            <i class="fas fa-trash-alt me-2"></i>Hapus Permanen
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.app')

@section('title', 'Detail Pelanggan')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card shadow">
                <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">
                        <i class="fas fa-user-circle me-2"></i>Detail Pelanggan
                    </h4>
                    <!-- PERBAIKI ROUTE: admin.pelanggan.index -->
                    <a href="{{ route('admin.pelanggan.index') }}" class="btn btn-light btn-sm">
                        <i class="fas fa-arrow-left me-1"></i>Kembali
                    </a>
                </div>
                
                <div class="card-body">
                    <div class="row">
                        <!-- Informasi Pelanggan -->
                        <div class="col-md-6">
                            <div class="card mb-4">
                                <div class="card-header bg-light">
                                    <h5 class="mb-0"><i class="fas fa-info-circle me-2"></i>Informasi Pelanggan</h5>
                                </div>
                                <div class="card-body">
                                    <table class="table table-borderless">
                                        <tr>
                                            <th width="40%">ID Pelanggan</th>
                                            <td>: {{ $pelanggan->id }}</td>
                                        </tr>
                                        <tr>
                                            <th>Nama Lengkap</th>
                                            <td>: {{ $pelanggan->nama_pelanggan }}</td>
                                        </tr>
                                        <tr>
                                            <th>Email</th>
                                            <td>: {{ $pelanggan->email ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Nomor Telepon</th>
                                            <td>: {{ $pelanggan->nomor_telepon }}</td>
                                        </tr>
                                        <tr>
                                            <th>Alamat</th>
                                            <td>: {{ $pelanggan->alamat }}</td>
                                        </tr>
                                        <tr>
                                            <th>Tanggal Daftar</th>
                                            <td>: {{ $pelanggan->created_at->format('d F Y H:i') }}</td>
                                        </tr>
                                        <tr>
                                            <th>Status Akun</th>
                                            <td>
                                                @if($pelanggan->user)
                                                    <span class="badge bg-success">Aktif</span>
                                                @else
                                                    <span class="badge bg-warning">Non-Aktif</span>
                                                @endif
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Informasi User -->
                        @if($pelanggan->user)
                        <div class="col-md-6">
                            <div class="card mb-4">
                                <div class="card-header bg-light">
                                    <h5 class="mb-0"><i class="fas fa-user me-2"></i>Informasi Akun</h5>
                                </div>
                                <div class="card-body">
                                    <table class="table table-borderless">
                                        <tr>
                                            <th width="40%">Username</th>
                                            <td>: {{ $pelanggan->user->name ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Email Akun</th>
                                            <td>: {{ $pelanggan->user->email }}</td>
                                        </tr>
                                        <tr>
                                            <th>ID User</th>
                                            <td>: {{ $pelanggan->user->id }}</td>
                                        </tr>
                                        <tr>
                                            <th>Akun Dibuat</th>
                                            <td>: {{ $pelanggan->user->created_at->format('d F Y') }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                    
                    <!-- Riwayat Pesanan -->
                    @if($pelanggan->pesanan && $pelanggan->pesanan->count() > 0)
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header bg-light">
                                    <h5 class="mb-0"><i class="fas fa-shopping-cart me-2"></i>Riwayat Pesanan</h5>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-sm table-hover">
                                            <thead>
                                                <tr>
                                                    <th>ID Pesanan</th>
                                                    <th>Tanggal</th>
                                                    <th>Status</th>
                                                    <th>Total</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($pelanggan->pesanan as $pesanan)
                                                <tr>
                                                    <td>#{{ $pesanan->id }}</td>
                                                    <td>{{ $pesanan->created_at->format('d/m/Y') }}</td>
                                                    <td>
                                                        <span class="badge bg-{{ $pesanan->status == 'selesai' ? 'success' : 'warning' }}">
                                                            {{ ucfirst($pesanan->status) }}
                                                        </span>
                                                    </td>
                                                    <td>Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</td>
                                                    <td>
                                                        <a href="#" class="btn btn-sm btn-outline-primary">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
                
                <div class="card-footer text-end">
                    <!-- HAPUS tombol EDIT karena admin tidak bisa edit -->
                    <!-- <a href="{{ route('pelanggan.edit', $pelanggan->id) }}" class="btn btn-warning">
                        <i class="fas fa-edit me-1"></i>Edit Pelanggan
                    </a> -->
                    
                    <!-- PERBAIKI ROUTE: admin.pelanggan.destroy -->
                    <form action="{{ route('admin.pelanggan.destroy', $pelanggan->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Hapus pelanggan ini?')">
                            <i class="fas fa-trash me-1"></i>Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@extends('layouts.admin')

@section('title', 'Detail Admin/Kasir')

@section('content')
<div class="container-fluid py-4">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4>Detail Admin/Kasir</h4>
        <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary btn-sm">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="row">
        <!-- Informasi Admin -->
        <div class="col-md-8">
            <!-- Header Profil -->
            <div class="card mb-3">
                <div class="card-body">
                    <h4 class="mb-2">{{ $admin->name }}</h4>
                    <div class="d-flex align-items-center">
                        @if($admin->role == 'admin')
                            <span class="badge bg-danger me-2">Administrator</span>
                        @else
                            <span class="badge bg-info me-2">Kasir</span>
                        @endif
                        <small class="text-muted">ID: {{ $admin->id }}</small>
                    </div>
                </div>
            </div>

            <!-- Data Admin -->
            <div class="card mb-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <strong class="d-block mb-1">Username</strong>
                            <code>{{ $admin->username }}</code>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <strong class="d-block mb-1">Email</strong>
                            <div>{{ $admin->email }}</div>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <strong class="d-block mb-1">Nomor Telepon</strong>
                            <div>{{ $admin->nomor_telepon }}</div>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <strong class="d-block mb-1">Status</strong>
                            @if($admin->status == 'aktif')
                                <span class="badge bg-success">Aktif</span>
                            @else
                                <span class="badge bg-danger">Nonaktif</span>
                            @endif
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <strong class="d-block mb-1">Dibuat</strong>
                            <div>{{ $admin->created_at->format('d/m/Y H:i') }}</div>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <strong class="d-block mb-1">Diupdate</strong>
                            <div>{{ $admin->updated_at->format('d/m/Y H:i') }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tombol Aksi -->
            <div class="d-flex justify-content-between">
                <a href="{{ route('admin.users.edit', $admin->id) }}" class="btn btn-warning px-4">
                    <i class="fas fa-edit me-2"></i> Edit
                </a>
                
                <form action="{{ route('admin.users.destroy', $admin->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger px-4">
                        <i class="fas fa-trash me-2"></i> Hapus
                    </button>
                </form>
            </div>
        </div>
        
        <!-- Card Status -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-body text-center">
                    <div class="mb-4">
                        <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center" 
                             style="width: 100px; height: 100px;">
                            <i class="fas fa-user fa-3x text-danger"></i>
                        </div>
                    </div>
                    
                    <h5 class="mb-3">{{ $admin->name }}</h5>
                    
                    <div class="mb-3">
                        @if($admin->role == 'admin')
                            <span class="badge bg-danger p-2 fs-6">Administrator</span>
                        @else
                            <span class="badge bg-info p-2 fs-6">Kasir</span>
                        @endif
                    </div>
                    
                    <div class="mb-4">
                        @if($admin->status == 'aktif')
                            <span class="badge bg-success p-2 fs-6">Akun Aktif</span>
                        @else
                            <span class="badge bg-danger p-2 fs-6">Akun Nonaktif</span>
                        @endif
                    </div>
                    
                    <div class="text-muted">
                        <small>
                            <i class="fas fa-calendar me-1"></i>
                            Bergabung: {{ $admin->created_at->format('d M Y') }}
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

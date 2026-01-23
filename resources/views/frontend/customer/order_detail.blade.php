@extends('frontend.layouts.front')

@section('title', 'Detail Pesanan #' . $order->nomor_pesanan . ' - Pangsit Chili Oil')

@section('content')
<div class="container py-5" style="min-height: 80vh;">
    <div class="row">
        <div class="col-12">
            <!-- Header & Kembali -->
            <div class="d-flex align-items-center mb-4">
                <a href="{{ route('customer.orders') }}" class="btn glass-btn-dark me-3">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <div>
                    <h2 class="fw-bold mb-0">Detail <span class="text-danger">Pesanan</span></h2>
                    <p class="text-muted mb-0">#{{ $order->nomor_pesanan }} &bull; {{ $order->created_at->format('d M Y, H:i') }} WIB</p>
                </div>
            </div>

            <div class="row g-4">
                <!-- Progres Pesanan (Stepper) -->
                <div class="col-12">
                    <div class="card glass-card border-0 p-4 mb-4">
                        <h5 class="fw-bold mb-4">Status Transaksi</h5>
                        <div class="order-stepper">
                            @php
                                $statusSteps = [
                                    'menunggu' => 1,
                                    'dikonfirmasi' => 2,
                                    'diproses' => 3,
                                    'selesai' => 4
                                ];
                                $currentStep = $statusSteps[strtolower($order->status_pesanan)] ?? 1;
                                $isCancelled = strtolower($order->status_pesanan) == 'dibatalkan';
                            @endphp

                            @if($isCancelled)
                                <div class="alert alert-danger border-0 rounded-4 d-flex align-items-center p-4">
                                    <i class="fas fa-times-circle fa-2x me-3"></i>
                                    <div>
                                        <h6 class="fw-bold mb-1">Pesanan Dibatalkan</h6>
                                        <p class="mb-0 opacity-75">Mohon maaf, pesanan ini telah dibatalkan. Silakan hubungi admin jika ada kendala.</p>
                                    </div>
                                </div>
                            @else
                                <div class="stepper-wrapper">
                                    <div class="stepper-item {{ $currentStep >= 1 ? 'completed' : '' }}">
                                        <div class="step-counter"><i class="fas fa-clock"></i></div>
                                        <div class="step-name">Menunggu</div>
                                    </div>
                                    <div class="stepper-item {{ $currentStep >= 2 ? 'completed' : '' }}">
                                        <div class="step-counter"><i class="fas fa-check"></i></div>
                                        <div class="step-name">Dikonfirmasi</div>
                                    </div>
                                    <div class="stepper-item {{ $currentStep >= 3 ? 'completed' : '' }}">
                                        <div class="step-counter"><i class="fas fa-utensils"></i></div>
                                        <div class="step-name">Diproses</div>
                                    </div>
                                    <div class="stepper-item {{ $currentStep >= 4 ? 'completed' : '' }}">
                                        <div class="step-counter"><i class="fas fa-box-open"></i></div>
                                        <div class="step-name">Selesai</div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Rincian Item -->
                <div class="col-lg-8">
                    <div class="card glass-card border-0 p-0 overflow-hidden h-100">
                        <div class="card-header bg-transparent border-bottom p-4">
                            <h5 class="fw-bold mb-0">Item Pesanan</h5>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead class="bg-light">
                                        <tr>
                                            <th class="ps-4">Produk</th>
                                            <th class="text-center">Harga</th>
                                            <th class="text-center">Jumlah</th>
                                            <th class="text-end pe-4">Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($order->items as $item)
                                        <tr>
                                            <td class="ps-4 py-4">
                                                <div class="d-flex align-items-center">
                                                    <img src="{{ $item->produk->gambar ? asset('storage/' . $item->produk->gambar) : asset('images/no-image.png') }}" 
                                                         class="rounded-3 me-3" 
                                                         style="width: 60px; height: 60px; object-fit: cover; border: 2px solid #eee;">
                                                    <div>
                                                        <h6 class="fw-bold mb-0 text-dark">{{ $item->produk->nama_produk }}</h6>
                                                        <small class="text-muted">{{ $item->produk->kategori->nama_kategori }}</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-center align-middle">Rp {{ number_format($item->harga_saat_ini, 0, ',', '.') }}</td>
                                            <td class="text-center align-middle">x{{ $item->jumlah }}</td>
                                            <td class="text-end pe-4 align-middle fw-bold">Rp {{ number_format($item->harga_saat_ini * $item->jumlah, 0, ',', '.') }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Ringkasan Pembayaran -->
                <div class="col-lg-4">
                    <div class="card glass-card border-0 p-4 sticky-top" style="top: 2rem;">
                        <h5 class="fw-bold mb-4">Ringkasan Pembayaran</h5>
                        
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Total Belanja</span>
                            <span>Rp {{ number_format($order->total_harga - 2000, 0, ',', '.') }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Biaya Layanan</span>
                            <span>Rp 2.000</span>
                        </div>
                        <hr class="my-3 opacity-10">
                        <div class="d-flex justify-content-between mb-4">
                            <h5 class="fw-bold text-dark">Total Bayar</h5>
                            <h5 class="fw-bold text-danger">Rp {{ number_format($order->total_harga, 0, ',', '.') }}</h5>
                        </div>

                        <div class="alert bg-success bg-opacity-10 border-0 rounded-4 p-3 mb-4">
                            <div class="d-flex align-items-center text-success mb-2">
                                <i class="fab fa-whatsapp me-2"></i>
                                <span class="fw-bold small">Konfirmasi Pembayaran</span>
                            </div>
                            <p class="small text-muted mb-0">Silakan kirim bukti transfer ke WhatsApp kami untuk mempercepat proses pesanan.</p>
                        </div>

                        <a href="https://wa.me/{{ config('services.whatsapp.number') }}?text=Halo%20Admin%2C%20saya%20ingin%20konfirmasi%20pembayaran%20untuk%20pesanan%20{{ $order->nomor_pesanan }}" 
                           target="_blank" 
                           class="btn btn-success btn-lg w-100 py-3 rounded-4 shadow-sm">
                            <i class="fab fa-whatsapp me-2"></i> Hubungi Admin
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    /* Stepper Styling */
    .stepper-wrapper {
        display: flex;
        justify-content: space-between;
        margin-top: 20px;
        position: relative;
    }
    .stepper-wrapper::before {
        content: '';
        position: absolute;
        top: 25px;
        left: 0;
        width: 100%;
        height: 4px;
        background: #eee;
        z-index: 1;
    }
    .stepper-item {
        position: relative;
        display: flex;
        flex-direction: column;
        align-items: center;
        flex: 1;
        z-index: 2;
    }
    .step-counter {
        width: 50px;
        height: 50px;
        background: #fff;
        border: 4px solid #eee;
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        font-weight: bold;
        color: #64748b;
        transition: all 0.3s ease;
    }
    .stepper-item.completed:nth-child(1) .step-counter { background: #ffc107; border-color: #ffc107; color: #000; }
    .stepper-item.completed:nth-child(2) .step-counter { background: #0dcaf0; border-color: #0dcaf0; color: #000; }
    .stepper-item.completed:nth-child(3) .step-counter { background: #0d6efd; border-color: #0d6efd; color: #fff; }
    .stepper-item.completed:nth-child(4) .step-counter { background: #198754; border-color: #198754; color: #fff; }
    
    .step-name {
        margin-top: 10px;
        font-size: 0.85rem;
        font-weight: 600;
        color: #64748b;
    }
    .stepper-item.completed .step-name {
        color: var(--dark-brown);
    }
    
    /* Active step glow effect */
    .stepper-item.completed:not(.completed + .completed) .step-counter {
        box-shadow: 0 0 15px rgba(0,0,0,0.1);
        transform: scale(1.1);
    }
    
    /* Table Fixes */
    .table thead th {
        border-top: none;
        color: #64748b;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 1px;
        padding: 1rem 0.75rem;
    }
</style>
@endpush

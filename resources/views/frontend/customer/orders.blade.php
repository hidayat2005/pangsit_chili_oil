@extends('frontend.layouts.front')

@section('title', 'Pesanan Saya - Pangsit Chili Oil')

@section('content')
<div class="container py-5" style="min-height: 70vh;">
    <div class="row">
        <div class="col-12">
            <div class="d-flex align-items-center mb-4">
                <a href="{{ route('home') }}" class="btn glass-btn-dark me-3">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <h2 class="fw-bold mb-0">Pesanan <span class="text-danger">Saya</span></h2>
            </div>

            <div class="card glass-card border-0 p-4">
                @if($orders->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Nomor Pesanan</th>
                                    <th>Tanggal</th>
                                    <th>Total Harga</th>
                                    <th>Status</th>
                                    <th class="text-end">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $order)
                                <tr>
                                    <td class="fw-bold text-danger">{{ $order->nomor_pesanan }}</td>
                                    <td>{{ $order->created_at->format('d M Y, H:i') }}</td>
                                    <td>Rp {{ number_format($order->total_harga, 0, ',', '.') }}</td>
                                    <td>
                                        @php
                                            $statusClass = 'bg-secondary';
                                            $statusText = $order->status_pesanan;
                                            
                                            switch(strtolower($order->status_pesanan)) {
                                                case 'menunggu': $statusClass = 'bg-warning text-dark'; break;
                                                case 'dikonfirmasi': $statusClass = 'bg-info text-dark'; break;
                                                case 'diproses': $statusClass = 'bg-primary text-white'; break;
                                                case 'selesai': $statusClass = 'bg-success text-white'; break;
                                                case 'dibatalkan': $statusClass = 'bg-danger text-white'; break;
                                            }
                                        @endphp
                                        <span class="badge rounded-pill {{ $statusClass }} px-3">
                                            {{ ucfirst($statusText) }}
                                        </span>
                                    </td>
                                    <td class="text-end">
                                        <div class="d-flex justify-content-end gap-2">
                                            <a href="{{ route('customer.order.detail', $order->id) }}" 
                                               class="btn btn-outline-danger btn-sm rounded-pill px-3">
                                                <i class="fas fa-eye me-1"></i> Detail
                                            </a>
                                            <a href="https://wa.me/{{ config('services.whatsapp.number') }}?text=Halo%2C%20saya%20ingin%20bertanya%20tentang%20pesanan%20{{ $order->nomor_pesanan }}" 
                                               target="_blank" 
                                               class="btn glass-btn-danger btn-sm">
                                                <i class="fab fa-whatsapp me-1"></i> Hubungi Admin
                                            </a>
                                            
                                            <!-- Tombol Hapus (Hanya muncul jika status memungkinkan) -->
                                            @if(in_array(strtolower($order->status_pesanan), ['menunggu', 'dibatalkan']))
                                            <form action="{{ route('customer.orders.destroy', $order->id) }}" method="POST" class="delete-order-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-link text-danger p-0 ms-2" title="Hapus Pesanan">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-5">
                        <div class="mb-4">
                            <i class="fas fa-shopping-bag fa-4x text-muted opacity-25"></i>
                        </div>
                        <h4 class="fw-bold text-muted">Belum Ada Pesanan</h4>
                        <p class="text-muted mb-4">Sepertinya Anda belum melakukan pemesanan apapun.</p>
                        <a href="{{ route('front.products') }}" class="btn btn-danger px-4 py-2 rounded-pill">
                            Mulai Belanja
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .table thead th {
        border-top: none;
        color: var(--dark-brown);
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.8rem;
        letter-spacing: 1px;
    }
    .table td {
        vertical-align: middle;
        padding: 1.2rem 0.75rem;
    }
</style>
@endpush

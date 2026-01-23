@extends('layouts.admin')

@section('title', 'Laporan Penjualan')

@section('content')
    <!-- Header -->
    <div class="row mb-4">
        <div class="col">
            <div class="glass-card p-4 d-flex justify-content-between align-items-center flex-wrap gap-3">
                <div>
                    <h2 class="fw-bold mb-1">Laporan Penjualan</h2>
                    <p class="text-muted mb-0">Analisis performa bisnis Pangsit Chili Oil Anda.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Alert Notifikasi Pesanan Baru (Real-time Details) -->
    @if(isset($notifikasiPesanans) && $notifikasiPesanans->count() > 0)
    <div class="row mb-4 animate__animated animate__fadeIn" id="notificationSection">
        <div class="col-12">
            <div class="card border-0 shadow-sm overflow-hidden" style="border-left: 5px solid #dc3545 !important; background: #fff5f5;">
                <div class="card-header bg-white border-0 py-3 px-4 d-flex justify-content-between align-items-center">
                    <h6 class="mb-0 fw-bold text-danger">
                        <i class="fas fa-bell me-2 fa-shake"></i>
                        {{ $notifikasiPesanans->count() }} Notifikasi Pesanan Baru
                    </h6>
                    <button class="btn btn-sm btn-outline-danger border-0 small fw-bold" onclick="markAllAsNotified()">
                        <i class="fas fa-check-double me-1"></i> Tandai Mengetahui Semua
                    </button>
                </div>
                <div class="card-body p-0">
                    <div style="max-height: 300px; overflow-y: auto;" class="custom-scrollbar">
                        <div class="list-group list-group-flush">
                            @foreach($notifikasiPesanans as $notif)
                            <div class="list-group-item bg-transparent py-3 px-4 border-bottom-dashed">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-danger text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                                            <i class="fas fa-shopping-basket"></i>
                                        </div>
                                        <div>
                                            <div class="fw-bold text-dark">
                                                Pesanan dari <span class="text-danger">{{ $notif->pelanggan->nama_pelanggan ?? 'Pelanggan' }}</span>
                                            </div>
                                            <div class="text-muted small">
                                                #{{ $notif->nomor_pesanan }} &bull; {{ $notif->created_at->diffForHumans() }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-end">
                                        <div class="fw-bold text-dark mb-1">Rp {{ number_format($notif->total_harga, 0, ',', '.') }}</div>
                                        <span class="badge bg-warning text-dark rounded-pill px-3 py-1 small">MENUNGGU</span>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Statistik Utama -->
    <div class="row g-4 mb-4">
        <div class="col-12">
            <div class="row g-4">
                <div class="col-md-6 col-xl-4">
                    <div class="card h-100 border-0 shadow-sm" style="border-left: 5px solid #10b981 !important;">
                        <div class="card-body p-4">
                            <div class="text-muted small fw-bold text-uppercase mb-1">Total Pendapatan</div>
                            <h3 class="fw-bold text-dark mb-0">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</h3>
                            <div class="mt-2 small text-success"><i class="fas fa-chart-line me-1"></i> Omzet Kotor</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-4">
                    <div class="card h-100 border-0 shadow-sm" style="border-left: 5px solid #3b82f6 !important;">
                        <div class="card-body p-4">
                            <div class="text-muted small fw-bold text-uppercase mb-1">Jumlah Pesanan</div>
                            <h3 class="fw-bold text-dark mb-0">{{ $jumlahPesanan }} Transaksi</h3>
                            <div class="mt-2 small text-primary"><i class="fas fa-shopping-bag me-1"></i> Pesanan Masuk</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-4">
                    <div class="card h-100 border-0 shadow-sm" style="border-left: 5px solid #f59e0b !important;">
                        <div class="card-body p-4">
                            <div class="text-muted small fw-bold text-uppercase mb-1">Rata-rata Transaksi</div>
                            <h3 class="fw-bold text-dark mb-0">Rp {{ number_format($rataRataTransaksi, 0, ',', '.') }}</h3>
                            <div class="mt-2 small text-warning"><i class="fas fa-percentage me-1"></i> Per Pesanan</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content: Tabel Laporan -->
    <div class="row">
        <div class="col-12">
            <div class="table-card p-0 shadow-lg">
                <div class="card-header bg-white py-4 px-4 border-bottom d-flex justify-content-between align-items-center">
                    <h5 class="fw-bold mb-0 text-dark">Rincian Transaksi Penjualan</h5>
                    <div class="badge bg-light text-dark px-3 py-2 border">Data: {{ $startDate->format('d/m/Y') }} - {{ $endDate->format('d/m/Y') }}</div>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr class="bg-light">
                                <th class="text-center" width="80">No</th>
                                <th>Tanggal</th>
                                <th>No. Pesanan</th>
                                <th>Pelanggan</th>
                                <th class="text-end">Total Harga</th>
                                <th class="text-center">Status</th>
                                <th class="text-center" width="100">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pesanans as $index => $pesanan)
                            <tr>
                                <td class="text-center align-middle text-muted">{{ $pesanans->firstItem() + $index }}</td>
                                <td class="align-middle">
                                    <div class="fw-bold">{{ $pesanan->created_at->format('d M Y') }}</div>
                                    <small class="text-muted">{{ $pesanan->created_at->format('H:i') }} WIB</small>
                                </td>
                                <td class="align-middle">
                                    <span class="badge bg-light text-dark border px-2 py-1">#{{ $pesanan->nomor_pesanan }}</span>
                                </td>
                                <td class="align-middle">
                                    <div class="fw-bold text-dark">{{ $pesanan->pelanggan->nama_pelanggan ?? 'Walk-in Customer' }}</div>
                                    <small class="text-muted"><i class="fas fa-phone-alt me-1"></i> {{ $pesanan->pelanggan->nomor_telepon ?? '-' }}</small>
                                </td>
                                <td class="text-end align-middle fw-bold text-success">
                                    Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}
                                </td>
                                <td class="text-center align-middle">
                                    <div class="dropdown">
                                        @php
                                            $statusClass = [
                                                'selesai' => 'bg-success',
                                                'diproses' => 'bg-primary',
                                                'dikonfirmasi' => 'bg-info',
                                                'menunggu' => 'bg-warning text-dark',
                                                'dibatalkan' => 'bg-danger'
                                            ][$pesanan->status_pesanan] ?? 'bg-secondary';
                                        @endphp
                                        <button class="badge {{ $statusClass }} rounded-pill px-3 py-1 text-uppercase small border-0 dropdown-toggle" 
                                                type="button" data-bs-toggle="dropdown" aria-expanded="false" style="cursor: pointer;">
                                            {{ $pesanan->status_pesanan }}
                                        </button>
                                        <ul class="dropdown-menu shadow border-0 rounded-4 p-2">
                                            <li><h6 class="dropdown-header small text-uppercase fw-bold">Ubah Status</h6></li>
                                            @foreach(['menunggu', 'dikonfirmasi', 'diproses', 'selesai', 'dibatalkan'] as $st)
                                                @if($st !== $pesanan->status_pesanan)
                                                <li>
                                                    <a class="dropdown-item rounded-3 mb-1 update-status-btn" 
                                                       href="javascript:void(0)" 
                                                       data-id="{{ $pesanan->id }}" 
                                                       data-status="{{ $st }}">
                                                        <i class="fas fa-circle me-2 small text-{{ 
                                                            $st == 'selesai' ? 'success' : 
                                                            ($st == 'dibatalkan' ? 'danger' : 
                                                            ($st == 'menunggu' ? 'warning' : 'primary')) 
                                                        }}"></i>
                                                        {{ ucfirst($st) }}
                                                    </a>
                                                </li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </div>
                                </td>
                                <td class="text-center align-middle">
                                    <button class="btn btn-sm btn-light border show-detail-btn" 
                                            data-id="{{ $pesanan->id }}" 
                                            title="Detail Transaksi">
                                        <i class="fas fa-eye text-primary"></i>
                                    </button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center py-5">
                                    <div class="mb-3"><i class="fas fa-file-invoice-dollar fa-4x text-muted opacity-25"></i></div>
                                    <h5 class="text-muted">Tidak ada data penjualan pada periode ini.</h5>
                                    @if($jumlahPesanan == 0)
                                        <p class="text-muted small">Klik "Buat Data Contoh" untuk mencoba fitur laporan.</p>
                                    @endif
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($pesanans->hasPages())
                <div class="px-4 py-3 border-top">
                    {{ $pesanans->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Modal Detail Pesanan -->
    <div class="modal fade" id="detailPesananModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg" style="border-radius: 20px;">
                <div class="modal-header border-0 pb-0 px-4 pt-4">
                    <div>
                        <h5 class="modal-title fw-bold" id="detailNomorPesanan">#ORD-XXXXX</h5>
                        <p class="text-muted small mb-0" id="detailTanggalPesanan">Tanggal - Jam</p>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-4 pb-4">
                    <div class="row mb-4 pt-3">
                        <div class="col-6">
                            <h6 class="text-muted small text-uppercase fw-bold mb-1">Pelanggan</h6>
                            <p class="fw-bold mb-0" id="detailNamaPelanggan">-</p>
                        </div>
                        <div class="col-6 text-end">
                            <h6 class="text-muted small text-uppercase fw-bold mb-1">Status</h6>
                            <span class="badge rounded-pill px-3 py-1 text-uppercase" id="detailStatusPesanan">-</span>
                        </div>
                    </div>

                    <div class="table-responsive rounded-3 border">
                        <table class="table table-hover mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="small fw-bold border-0">Item Produk</th>
                                    <th class="small fw-bold border-0 text-center">Jumlah</th>
                                    <th class="small fw-bold border-0 text-end">Harga</th>
                                    <th class="small fw-bold border-0 text-end">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody id="detailItemsContainer">
                                <!-- Ajax Content -->
                            </tbody>
                        </table>
                    </div>

                    <div class="row mt-4 pt-3 border-top">
                        <div class="col-6 ms-auto text-end">
                            <h5 class="fw-bold text-success" id="detailTotalHarga">Total: Rp 0</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@push('scripts')
<script>
    $(document).ready(function() {
        $('.update-status-btn').on('click', function() {
            const id = $(this).data('id');
            const status = $(this).data('status');
            const statusText = $(this).text().trim();
            
            Swal.fire({
                title: 'Ubah Status Pesanan?',
                text: `Apakah Anda yakin ingin mengubah status pesanan ini menjadi "${statusText}"?`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#10b981',
                cancelButtonColor: '#64748b',
                confirmButtonText: 'Ya, Ubah!',
                cancelButtonText: 'Batal',
                reverseButtons: true,
                customClass: {
                    confirmButton: 'btn btn-success px-4',
                    cancelButton: 'btn btn-secondary px-4 me-3'
                },
                buttonsStyling: false
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `/admin/laporan/${id}/status`,
                        type: 'PATCH',
                        data: {
                            _token: '{{ csrf_token() }}',
                            status: status
                        },
                        success: function(response) {
                            if (response.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil!',
                                    text: response.message,
                                    timer: 2000,
                                    showConfirmButton: false
                                }).then(() => {
                                    location.reload();
                                });
                            }
                        },
                        error: function(xhr) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal!',
                                text: xhr.responseJSON?.message || 'Terjadi kesalahan saat mengupdate status.'
                            });
                        }
                    });
                }
            });
        });
    });

    /**
     * Tandai semua pesanan baru sebagai sudah dinotifikasi
     */
    function markAllAsNotified() {
        $.post("{{ route('admin.orders.markNotified') }}", {
            _token: "{{ csrf_token() }}"
        }, function(response) {
            if (response.success) {
                $('#notificationSection').fadeOut(400, function() {
                    $(this).remove();
                });
                // Update sidebar badge too
                $('#sidebarOrderBadge').addClass('d-none');
            }
        });
    }
    /**
     * Show Order Details via AJAX
     */
    $('.show-detail-btn').on('click', function() {
        const id = $(this).data('id');
        
        // Show loading state or just open modal
        $('#detailItemsContainer').html('<tr><td colspan="4" class="text-center py-4"><div class="spinner-border spinner-border-sm text-primary me-2"></div>Memuat data...</td></tr>');
        $('#detailPesananModal').modal('show');

        $.get(`/admin/laporan/${id}`, function(response) {
            if (response.success) {
                const data = response.data;
                $('#detailNomorPesanan').text('#' + data.nomor_pesanan);
                $('#detailTanggalPesanan').text(data.tanggal + ' WIB');
                $('#detailNamaPelanggan').text(data.pelanggan);
                
                // Status Badge Color
                const status = data.status;
                let statusClass = 'bg-secondary';
                if (status === 'selesai') statusClass = 'bg-success';
                else if (status === 'diproses') statusClass = 'bg-primary';
                else if (status === 'dikonfirmasi') statusClass = 'bg-info';
                else if (status === 'menunggu') statusClass = 'bg-warning text-dark';
                else if (status === 'dibatalkan') statusClass = 'bg-danger';
                
                $('#detailStatusPesanan').text(status).attr('class', 'badge rounded-pill px-3 py-1 text-uppercase ' + statusClass);
                $('#detailTotalHarga').text('Total: Rp ' + data.total);

                let itemsHtml = '';
                data.items.forEach(item => {
                    itemsHtml += `
                        <tr>
                            <td class="align-middle">${item.nama}</td>
                            <td class="text-center align-middle">${item.jumlah}</td>
                            <td class="text-end align-middle">Rp ${item.harga}</td>
                            <td class="text-end align-middle fw-bold">Rp ${item.subtotal}</td>
                        </tr>
                    `;
                });
                $('#detailItemsContainer').html(itemsHtml);
            }
        });
    });
</script>
@endpush
@push('styles')
<style>
    .border-bottom-dashed {
        border-bottom: 1px dashed #dee2e6 !important;
    }
    .list-group-item:last-child {
        border-bottom: none !important;
    }
    .animate__fadeIn {
        animation-duration: 0.8s;
    }
    .custom-scrollbar::-webkit-scrollbar {
        width: 6px;
    }
    .custom-scrollbar::-webkit-scrollbar-track {
        background: #f1f1f1;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: #dc3545;
        border-radius: 10px;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover {
        background: #8b0000;
    }
</style>
@endpush
@endsection

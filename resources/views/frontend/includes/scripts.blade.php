<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Swiper.js -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<!-- Global scripts -->
<script>
    // Script umum yang digunakan di semua halaman
    $(document).ready(function() {
        // Navbar scroll effect - glassmorphism enhancement
        $(window).scroll(function() {
            if ($(this).scrollTop() > 50) {
                $('.main-header').addClass('scrolled');
            } else {
                $('.main-header').removeClass('scrolled');
            }
        });

        // ========== PELANGGAN NOTIFICATION SYSTEM ==========
        @auth
        function checkCustomerNotifications() {
            $.get("{{ route('api.notifications.check') }}", function(data) {
                const badge = $('#customerNotificationBadge');
                const dropdownBadge = $('#customerDropdownBadge');
                const list = $('#customerNotificationList');
                const noMsg = $('#noCustomerNotifMsg');

                if (data.count > 0) {
                    badge.text(data.count).removeClass('d-none');
                    dropdownBadge.text(data.count);
                    noMsg.addClass('d-none');

                    let html = '';
                    data.notifications.forEach(notif => {
                        let statusColor = 'warning';
                        if (notif.status_pesanan === 'selesai') statusColor = 'success';
                        if (notif.status_pesanan === 'dibatalkan') statusColor = 'danger';
                        if (notif.status_pesanan === 'diproses') statusColor = 'primary';
                        if (notif.status_pesanan === 'dikonfirmasi') statusColor = 'info';

                        html += `
                            <li class="p-3 border-bottom notification-item bg-light bg-opacity-50">
                                <div class="d-flex gap-3 align-items-start">
                                    <div class="bg-${statusColor} bg-opacity-10 text-${statusColor} p-2 rounded-circle" style="width: 35px; height: 35px; display: flex; align-items: center; justify-content: center;">
                                        <i class="fas fa-info-circle"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <div class="fw-bold text-dark small" style="font-size: 0.75rem;">Status Pesanan Berubah</div>
                                        <div class="text-muted" style="font-size: 0.7rem;">
                                            Pesanan #${notif.nomor_pesanan} sekarang <span class="badge bg-${statusColor} rounded-pill px-2 py-0" style="font-size: 0.6rem;">${notif.status_pesanan.toUpperCase()}</span>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        `;
                    });
                    list.html(html);
                } else {
                    badge.addClass('d-none');
                    dropdownBadge.text('0');
                    noMsg.removeClass('d-none');
                    list.empty();
                }
            });
        }

        // Jalankan polling setiap 30 detik
        setInterval(checkCustomerNotifications, 30000);
        checkCustomerNotifications(); // Jalankan sekali saat load

        // Mark as read when dropdown opened
        $('#customerNotificationDropdown').on('show.bs.dropdown', function () {
            const orderIds = [];
            // Collect all IDs currently in the list
            if ($('#customerNotificationBadge').text() !== '0') {
                $.get("{{ route('api.notifications.check') }}", function(data) {
                    if (data.count > 0) {
                        const ids = data.notifications.map(n => n.id);
                        $.post("{{ route('api.notifications.markRead') }}", {
                            _token: "{{ csrf_token() }}",
                            order_ids: ids
                        }, function() {
                            $('#customerNotificationBadge').addClass('d-none');
                            $('#customerDropdownBadge').text('0');
                        });
                    }
                });
            }
        });
        @endauth
    });
</script>

@stack('scripts') <!-- Untuk script tambahan per halaman -->
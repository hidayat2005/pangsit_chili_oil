<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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
    });
</script>

@stack('scripts') <!-- Untuk script tambahan per halaman -->
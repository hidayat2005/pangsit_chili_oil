<!DOCTYPE html>
<html lang="id">
<head>
    @include('frontend.includes.meta')
    @include('frontend.includes.styles')
</head>
<body>
    @include('frontend.partials.header')
    
    <!-- Flash Messages (Floating Toast) -->
    <div id="toast-container" style="position: fixed; top: 20px; left: 20px; z-index: 9999; max-width: 400px; width: 90%;">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm slide-in-left custom-toast" role="alert">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0 me-3">
                        <i class="fas fa-check-circle fa-2x text-success"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold mb-1 text-success">Berhasil!</h6>
                        <p class="mb-0 text-dark small">{{ session('success') }}</p>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm slide-in-left custom-toast" role="alert">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0 me-3">
                        <i class="fas fa-exclamation-circle fa-2x text-danger"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold mb-1 text-danger">Gagal!</h6>
                        <p class="mb-0 text-dark small">{{ session('error') }}</p>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    </div>
    
    <main>
        @yield('content')
    </main>
    
    @include('frontend.partials.footer')
    @include('frontend.includes.scripts')
    @include('frontend.includes.cart-script')
    
    @stack('scripts')
</body>
</html>
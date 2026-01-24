<header class="main-header">
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <!-- Logo -->
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="{{ asset('images/Logo_Chili.png') }}" alt="Logo" style="height: 40px;" class="me-2">
                PANGSIT CHILI OIL
            </a>
            
            <!-- Mobile Toggle -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain" aria-controls="navbarMain" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <!-- Nav Menu -->
            <div class="collapse navbar-collapse" id="navbarMain">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ route('home') }}">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('produk*') ? 'active' : '' }}" href="{{ route('front.products') }}">Produk</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('tentang*') ? 'active' : '' }}" href="{{ route('about') }}">Tentang</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('kontak*') ? 'active' : '' }}" href="{{ route('contact') }}">Kontak</a>
                    </li>
                </ul>
                
                <!-- Right Side Icons -->
                <div class="navbar-nav d-flex flex-row align-items-center gap-2">
                    <!-- Cart -->
                    @php
                        $cartCount = array_sum(array_column(session('cart', []), 'quantity'));
                    @endphp
                    <a href="{{ route('cart.index') }}" class="nav-link position-relative cart-icon">
                        <i class="fas fa-shopping-bag"></i>
                        <span class="cart-badge {{ $cartCount == 0 ? 'd-none' : '' }}" id="cart-count">{{ $cartCount }}</span>
                    </a>

                    @auth
                    <!-- Notifications -->
                    <div class="dropdown me-1" id="customerNotificationDropdown">
                        <a href="#" class="nav-link position-relative" role="button" data-bs-toggle="dropdown" id="notificationBellButton">
                            <i class="fas fa-bell"></i>
                            <span id="customerNotificationBadge" class="position-absolute top-1 start-100 translate-middle badge rounded-pill bg-danger d-none" style="font-size: 0.6rem; padding: 0.25em 0.5em;">
                                0
                            </span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0 p-0 overflow-hidden" style="width: 300px;">
                            <li class="bg-danger text-white p-3 d-flex justify-content-between align-items-center">
                                <h6 class="mb-0 fw-bold small"><i class="fas fa-concierge-bell me-2"></i>Status Pesanan</h6>
                                <span class="badge bg-white text-danger px-2 py-1 small rounded-pill" id="customerDropdownBadge">0</span>
                            </li>
                            <div id="customerNotificationList" class="p-0" style="max-height: 300px; overflow-y: auto;">
                                <!-- Content will be populated by JS -->
                                <div class="text-center py-4 text-muted small" id="noCustomerNotifMsg">
                                    <i class="fas fa-check-circle d-block mb-2 fs-3 opacity-25"></i>
                                    Belum ada pembaruan status
                                </div>
                            </div>
                            <li class="border-top p-2 text-center bg-light">
                                <a href="{{ route('customer.orders') }}" class="text-muted small text-decoration-none fw-bold">
                                    <i class="fas fa-eye me-1"></i> Lihat Pesanan Saya
                                </a>
                            </li>
                        </ul>
                    </div>
                    @endauth
                    
                    <!-- TAMBAHKAN LINK DASHBOARD ADMIN SEBELUM USER DROPDOWN -->
                    @auth
                        @if(auth()->user()->role == 'admin')
                            <a class="nav-link d-flex align-items-center" href="{{ route('admin.index') }}" 
                               style="color: var(--primary-red); font-weight: 600;"
                               title="Dashboard Admin">
                                <i class="fas fa-tachometer-alt me-1"></i>
                                <span>Dashboard</span>
                            </a>
                        @endif
                    @endauth
                    
                    <!-- User Auth -->
                    @auth
                    <div class="dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user-circle me-1"></i>
                            <span>{{ auth()->user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <!-- TAMBAHKAN MENU ADMIN JIKA ROLE ADMIN -->
                            @if(auth()->user()->role == 'admin' || auth()->user()->role == 'kasir')
                                <li><a class="dropdown-item" href="{{ route('admin.index') }}">
                                    <i class="fas fa-tachometer-alt me-2"></i>Dashboard Admin
                                </a></li>
                                <li><hr class="dropdown-divider"></li>
                            @endif
                            
                            <li><a class="dropdown-item" href="{{ route('customer.profile') }}"><i class="fas fa-user me-2"></i>Profil</a></li>
                            <li><a class="dropdown-item" href="{{ route('customer.orders') }}"><i class="fas fa-clipboard-list me-2"></i>Pesanan Saya</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item"><i class="fas fa-sign-out-alt me-2"></i>Logout</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                    @else
                    <a href="{{ route('login') }}" class="btn btn-outline-custom me-2">Login</a>
                    <a href="{{ route('register') }}" class="btn btn-primary-custom">Daftar</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>
</header>
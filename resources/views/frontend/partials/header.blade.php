<header class="main-header">
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <!-- Logo -->
            <a class="navbar-brand" href="{{ route('home') }}">
                <i class="fas fa-pepper-hot"></i>
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
                        <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ route('home') }}">Home</a>
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
                    <a href="{{ route('cart.index') }}" class="nav-link position-relative cart-icon">
                        <i class="fas fa-shopping-bag"></i>
                        <span class="cart-badge" id="cart-count">0</span>
                    </a>
                    
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
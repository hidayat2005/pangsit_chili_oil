<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - @yield('title')</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/Logo_Chili.png') }}">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;601;700;800&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --primary-red: #dc3545;
            --dark-red: #8b0000;
            --accent-orange: #fd7e14;
            --sidebar-bg: #1a1a1a;
            --glass-bg: rgba(255, 255, 255, 0.7);
            --glass-border: rgba(255, 255, 255, 0.3);
            --text-main: #1e293b;
            --text-muted: #64748b;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: #f8fafc;
            color: var(--text-main);
            overflow-x: hidden;
            margin: 0;
            padding: 0;
        }

        /* GLASS MORPHISM UTILITIES */
        .glass-card {
            background: var(--glass-bg);
            backdrop-filter: blur(10px);
            border: 1px solid var(--glass-border);
            border-radius: 16px;
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.07);
        }

        .glass-btn {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(5px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
        }

        /* SIDEBAR STYLING */
        .sidebar {
            height: 100vh;
            background: linear-gradient(180deg, #1e1e2d 0%, #161621 100%);
            width: 260px;
            position: fixed;
            left: 0;
            top: 0;
            z-index: 1000;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex;
            flex-direction: column;
        }

        .sidebar-header {
            padding: 2.5rem 1.5rem;
            text-align: center;
        }

        .brand-logo {
            font-size: 1.25rem;
            font-weight: 800;
            color: white;
            letter-spacing: 1px;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .brand-logo i {
            color: var(--primary-red);
            font-size: 1.5rem;
            filter: drop-shadow(0 0 8px rgba(220, 53, 69, 0.4));
        }

        .sidebar-menu {
            padding: 0.5rem 1rem;
            flex-grow: 1;
            overflow-y: auto;
            overflow-x: hidden;
            direction: rtl; /* Move scrollbar to left */
        }

        .sidebar-menu > * {
            direction: ltr; /* Reset text direction */
        }

        .sidebar-menu::-webkit-scrollbar {
            width: 5px;
        }

        .sidebar-menu::-webkit-scrollbar-track {
            background: transparent;
        }

        .sidebar-menu::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
        }

        .sidebar-menu::-webkit-scrollbar-thumb:hover {
            background: var(--primary-red);
        }

        .menu-label {
            color: #4b5563;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            padding: 1rem 0.5rem;
            letter-spacing: 0.05em;
        }

        .sidebar-item {
            color: #94a3b8;
            text-decoration: none;
            padding: 0.75rem 1rem;
            border-radius: 12px;
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 0.5rem;
            transition: all 0.2s ease;
            font-weight: 500;
            position: relative;
        }

        .sidebar-item:hover {
            color: white;
            background: rgba(255, 255, 255, 0.05);
        }

        .sidebar-item.active {
            color: white;
            background: var(--primary-red);
            box-shadow: 0 4px 15px rgba(220, 53, 69, 0.3);
        }

        .sidebar-item i {
            font-size: 1.1rem;
            width: 24px;
            text-align: center;
        }

        .sidebar-footer {
            padding: 1.5rem;
            border-top: 1px solid rgba(255,255,255,0.05);
        }

        /* MAIN CONTENT & TOPBAR */
        .main-content {
            margin-left: 260px;
            min-height: 100vh;
            transition: all 0.3s ease;
            background: #f8fafc;
        }

        .topbar {
            height: 70px;
            background: rgba(248, 250, 252, 0.8);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid #e2e8f0;
            padding: 0 2rem;
            position: sticky;
            top: 0;
            z-index: 999;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .page-title {
            font-weight: 700;
            font-size: 1.25rem;
            margin: 0;
            color: #0f172a;
        }

        .user-profile {
            background: white;
            padding: 6px 12px;
            border-radius: 50px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            display: flex;
            align-items: center;
            gap: 10px;
            border: 1px solid #e2e8f0;
        }

        .user-avatar {
            width: 32px;
            height: 32px;
            background: var(--primary-red);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 0.8rem;
        }

        .content-body {
            padding: 2rem;
        }

        /* OVERRIDE BOOTSTRAP */
        .card {
            border-radius: 16px;
            border: none;
            box-shadow: 0 4px 20px rgba(0,0,0,0.03);
            transition: all 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 30px rgba(0,0,0,0.06);
        }

        .btn {
            border-radius: 10px;
            padding: 0.6rem 1.5rem;
            font-weight: 600;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .btn-primary {
            background: var(--primary-red);
            border-color: var(--primary-red);
            box-shadow: 0 4px 12px rgba(220, 53, 69, 0.2);
        }

        .btn-primary:hover {
            background: #c82333;
            border-color: #c82333;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(220, 53, 69, 0.3);
        }

        /* TABLE CUSTOMIZATION */
        .table-card {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0,0,0,0.03);
        }

        .table thead th {
            background: #f8fafc;
            color: #64748b;
            text-transform: uppercase;
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 0.05em;
            padding: 1.25rem 1rem;
            border-bottom: 2px solid #f1f5f9;
        }

        .table tbody td {
            padding: 1rem;
            vertical-align: middle;
            color: #334155;
            border-bottom: 1px solid #f1f5f9;
        }

        /* ALERTS */
        .alert {
            border-radius: 12px;
            border: none;
        }

        /* RESPONSIVE */
        @media (max-width: 991.98px) {
            .main-content {
                margin-left: 0;
            }
        }

        /* COLLAPSED SIDEBAR (DESKTOP) */
        @media (min-width: 992px) {
            .sidebar {
                transition: width 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            }
            .sidebar.collapsed, 
            .sidebar-collapsed .sidebar {
                width: 80px;
            }
            .sidebar .brand-logo span,
            .sidebar .sidebar-item span,
            .sidebar .menu-label {
                transition: opacity 0.3s, visibility 0.3s;
                white-space: nowrap;
            }
            .sidebar.collapsed .brand-logo span,
            .sidebar.collapsed .sidebar-item span,
            .sidebar.collapsed .menu-label,
            .sidebar-collapsed .sidebar .brand-logo span,
            .sidebar-collapsed .sidebar .sidebar-item span,
            .sidebar-collapsed .sidebar .menu-label {
                opacity: 0;
                visibility: hidden;
                width: 0;
                display: none;
            }
            .sidebar.collapsed .sidebar-header,
            .sidebar-collapsed .sidebar .sidebar-header {
                padding: 1.5rem 0.5rem;
                transition: padding 0.3s;
            }
            .sidebar.collapsed .sidebar-footer,
            .sidebar-collapsed .sidebar .sidebar-footer {
                padding: 1rem 0.5rem;
                transition: padding 0.3s;
            }
            .sidebar.collapsed .sidebar-item,
            .sidebar-collapsed .sidebar .sidebar-item {
                justify-content: center;
                padding: 0.75rem 0;
                margin: 0.5rem;
            }
            .sidebar.collapsed .sidebar-item i,
            .sidebar-collapsed .sidebar .sidebar-item i {
                margin: 0;
                font-size: 1.25rem;
                transition: font-size 0.3s;
            }
            .sidebar.collapsed .sidebar-item.justify-content-between,
            .sidebar-collapsed .sidebar .sidebar-item.justify-content-between {
                justify-content: center !important;
            }
            .sidebar.collapsed .sidebar-item.justify-content-between #sidebarOrderBadge,
            .sidebar-collapsed .sidebar .sidebar-item.justify-content-between #sidebarOrderBadge {
                position: absolute;
                top: 5px;
                right: 5px;
            }
            .main-content {
                transition: margin-left 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            }
            .main-content.collapsed,
            .sidebar-collapsed .main-content {
                margin-left: 80px;
            }
        }

        /* ========== CUSTOM FLOATING TOAST ========== */
        .custom-toast {
            background: white !important;
            border-radius: 12px !important;
            box-shadow: 0 10px 30px rgba(0,0,0,0.15) !important;
            margin-bottom: 15px;
            pointer-events: auto;
        }
        
        .alert-success.custom-toast {
            border-left: 5px solid #28a745 !important;
        }
        
        .alert-danger.custom-toast, .alert-error.custom-toast {
            border-left: 5px solid #dc3545 !important;
        }

        .slide-in-left {
            animation: slideInLeft 0.5s cubic-bezier(0.25, 0.46, 0.45, 0.94) both;
        }
        
        @keyframes slideInLeft {
            0% { transform: translateX(-100%); opacity: 0; }
            100% { transform: translateX(0); opacity: 1; }
        }
        
        .fade-out {
            animation: fadeOut 0.5s ease-out forwards;
        }
        
        @keyframes fadeOut {
            0% { opacity: 1; transform: translateX(0); }
            100% { opacity: 0; transform: translateX(-20px); }
        }
    </style>
    <script>
        // Check sidebar state immediately to prevent flash
        (function() {
            const isCollapsed = localStorage.getItem('admin_sidebar_collapsed') === 'true';
            if (isCollapsed && window.innerWidth >= 992) {
                document.documentElement.classList.add('sidebar-collapsed');
            }
        })();
    </script>
    @stack('styles')
</head>
<body>
    <!-- Toast Notifications Container -->
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
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <a href="{{ route('admin.dashboard') }}" class="brand-logo">
                <img src="{{ asset('images/Logo_Chili.png') }}" alt="Logo" style="width: 32px; height: 32px; object-fit: contain;" class="me-2">
                <span>PANGSIT CP</span>
            </a>
        </div>
        
        <div class="sidebar-menu">
            <div class="menu-label">Main Menu</div>
            <a href="{{ route('admin.dashboard') }}" 
               class="sidebar-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="fas fa-chart-pie"></i>
                <span>Dashboard</span>
            </a>

            <div class="menu-label">E-Commerce</div>
            <a href="{{ route('admin.produk.index') }}" 
               class="sidebar-item {{ request()->routeIs('admin.produk*') ? 'active' : '' }}">
                <i class="fas fa-hamburger"></i>
                <span>Produk</span>
            </a>
            <a href="{{ route('admin.kategori.index') }}" 
               class="sidebar-item {{ request()->routeIs('admin.kategori*') ? 'active' : '' }}">
                <i class="fas fa-layer-group"></i>
                <span>Kategori</span>
            </a>

            <div class="menu-label">User Management</div>
            <a href="{{ route('admin.users.index') }}" 
               class="sidebar-item {{ request()->routeIs('admin.users*') ? 'active' : '' }}">
                <i class="fas fa-user-shield"></i>
                <span>Admin & Kasir</span>
            </a>
            <a href="{{ route('admin.pelanggan.index') }}" 
               class="sidebar-item {{ request()->routeIs('admin.pelanggan*') ? 'active' : '' }}">
                <i class="fas fa-users"></i>
                <span>Pelanggan</span>
            </a>
            <a href="{{ route('admin.laporan.index') }}" 
               class="sidebar-item {{ request()->routeIs('admin.laporan*') ? 'active' : '' }} d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center gap-3">
                    <i class="fas fa-file-invoice-dollar"></i>
                    <span>Laporan Penjualan</span>
                </div>
                <span id="sidebarOrderBadge" class="badge rounded-pill bg-danger d-none" style="font-size: 0.7rem; padding: 0.4em 0.6em;">0</span>
            </a>
            <a href="{{ route('admin.pengeluaran.index') }}" 
               class="sidebar-item {{ request()->routeIs('admin.pengeluaran*') ? 'active' : '' }}">
                <i class="fas fa-wallet"></i>
                <span>Pengeluaran Operasional</span>
            </a>
        </div>

        <div class="sidebar-footer">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="sidebar-item border-0 w-100 text-start bg-transparent py-2">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span>
                </button>
            </form>
        </div>
    </div>
    
    <!-- Main Content -->
    <div class="main-content">
        <!-- Topbar -->
        <div class="topbar">
            <div class="d-flex align-items-center gap-3">
                <button class="btn btn-sm border" id="sidebarToggle">
                    <i class="fas fa-bars"></i>
                </button>
                <h1 class="page-title">@yield('title', 'Admin Dashboard')</h1>
            </div>
            
            <div class="user-profile">
                <div class="text-end d-none d-sm-block">
                    <div class="fw-bold" style="font-size: 0.85rem;">{{ Auth::user()->name ?? 'Admin User' }}</div>
                    <div class="text-muted" style="font-size: 0.75rem;">{{ Auth::user()->role ?? 'Super Admin' }}</div>
                </div>
                <div class="user-avatar text-uppercase">
                    {{ substr(Auth::user()->name ?? 'A', 0, 1) }}
                </div>
            </div>
        </div>
        
        <!-- Content -->
        <div class="content-body">

            @if($errors->any())
                <div class="alert alert-danger border-0 shadow-sm mb-4" role="alert">
                    <div class="d-flex align-items-center mb-2">
                        <i class="fas fa-exclamation-triangle me-3 fs-4"></i>
                        <div class="fw-bold">Whoops! Something went wrong.</div>
                        <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
                    </div>
                    <ul class="mb-0 ps-5">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Page Content -->
            @yield('content')
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // Restore Sidebar Scroll Position
        const sidebar = document.querySelector('.sidebar-menu');
        if (sidebar) {
            const scrollPos = sessionStorage.getItem('sidebarScroll');
            if (scrollPos) {
                sidebar.scrollTop = scrollPos;
            }

            // Save position on any link click
            document.querySelectorAll('.sidebar-item').forEach(item => {
                item.addEventListener('click', () => {
                    sessionStorage.setItem('sidebarScroll', sidebar.scrollTop);
                });
            });
        }

        // Sidebar Toggle Logic (Desktop & Mobile)
        $('#sidebarToggle').on('click', function() {
            if ($(window).width() >= 992) {
                // Desktop Toggle
                $('#sidebar').toggleClass('collapsed');
                $('.main-content').toggleClass('collapsed');
                $('html').toggleClass('sidebar-collapsed');
                
                // Save preference
                const isCollapsed = $('#sidebar').hasClass('collapsed') || $('html').hasClass('sidebar-collapsed');
                localStorage.setItem('admin_sidebar_collapsed', isCollapsed);
            } else {
                // Mobile Toggle
                $('#sidebar').toggleClass('show');
            }
        });

        // Apply saved preference on page load
        $(document).ready(function() {
            if ($(window).width() >= 992) {
                const isCollapsed = localStorage.getItem('admin_sidebar_collapsed') === 'true';
                if (isCollapsed) {
                    $('#sidebar').addClass('collapsed');
                    $('.main-content').addClass('collapsed');
                    $('html').addClass('sidebar-collapsed');
                }
            }
        });

        // Common delete confirmation
        $(document).on('submit', 'form[action*="destroy"]', function(e) {
            e.preventDefault();
            const form = this;
            
            Swal.fire({
                title: 'Konfirmasi Hapus',
                text: "Data akan dihapus secara permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#64748b',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
                reverseButtons: true,
                customClass: {
                    confirmButton: 'btn btn-danger px-4',
                    cancelButton: 'btn btn-secondary px-4 me-3'
                },
                buttonsStyling: false
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });

        // Global function to auto-hide toasts (Floating Toast Style)
        function setupToastAutoClear() {
            const container = document.getElementById('toast-container');
            if (!container) return;

            const alerts = container.querySelectorAll('.alert:not(.manual-close)');
            alerts.forEach(alert => {
                if (!alert.dataset.timerseta) {
                    alert.dataset.timerseta = "true";
                    setTimeout(() => {
                        alert.classList.add('fade-out');
                        setTimeout(() => { alert.remove(); }, 500);
                    }, 5000);
                }
            });
        }

        // Mutation Observer for dynamic toasts
        if (typeof MutationObserver !== 'undefined') {
            const observer = new MutationObserver(setupToastAutoClear);
            document.addEventListener('DOMContentLoaded', () => {
                const container = document.getElementById('toast-container');
                if (container) {
                    observer.observe(container, { childList: true });
                }
            });
        }

        $(document).ready(setupToastAutoClear);

        // ========== SIDEBAR NOTIFICATION SYSTEM ==========
        function checkSidebarOrders() {
            $.get("{{ route('admin.orders.check') }}", function(data) {
                const badge = $('#sidebarOrderBadge');
                if (data.count > 0) {
                    badge.text(data.count).removeClass('d-none');
                    // Add subtle glow effect if count increases
                    if (parseInt(badge.data('prev-count') || 0) < data.count) {
                        badge.addClass('fa-bounce');
                        setTimeout(() => badge.removeClass('fa-bounce'), 2000);
                    }
                    badge.data('prev-count', data.count);
                } else {
                    badge.addClass('d-none');
                }
            });
        }

        // Auto-mark as notified when on Laporan page
        @if(request()->routeIs('admin.laporan*'))
            $(document).ready(function() {
                setTimeout(function() {
                    $.post("{{ route('admin.orders.markNotified') }}", {
                        _token: "{{ csrf_token() }}"
                    }, function() {
                        $('#sidebarOrderBadge').addClass('d-none');
                    });
                }, 2000); // Wait 2s to ensure the user actually "sees" the page
            });
        @endif

        // Polling every 20 seconds
        setInterval(checkSidebarOrders, 20000);
        $(document).ready(checkSidebarOrders);
    </script>
    
    @stack('scripts')
</body>
</html>
<style>
    :root {
        --primary-red: #DC3545;
        --primary-orange: #FF6B35;
        --accent-yellow: #FFD166;
        --light-cream: #FFF9F0;
        --dark-brown: #4A2C2A;
        --light-gray: #F8F9FA;
    }
    
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
    
    body {
        font-family: 'Poppins', sans-serif;
        background-color: var(--light-cream);
        color: #333;
        line-height: 1.6;
    }
    
    /* HEADER & NAVBAR - ADVANCED GLASSMORPHISM */
    .main-header {
        background: linear-gradient(
            to bottom,
            rgba(255, 255, 255, 0.15),
            rgba(255, 249, 240, 0.12)
        );
        backdrop-filter: blur(30px) saturate(200%) brightness(110%);
        -webkit-backdrop-filter: blur(30px) saturate(200%) brightness(110%);
        box-shadow: 
            0 8px 32px 0 rgba(31, 38, 135, 0.08),
            inset 0 1px 0 0 rgba(255, 255, 255, 0.5);
        border: 1px solid rgba(255, 255, 255, 0.25);
        border-bottom: 1px solid rgba(220, 53, 69, 0.2);
        position: sticky;
        top: 0;
        z-index: 1050;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    /* Navbar scrolled state - enhanced glass effect */
    .main-header.scrolled {
        background: linear-gradient(
            to bottom,
            rgba(255, 255, 255, 0.35),
            rgba(255, 249, 240, 0.3)
        );
        backdrop-filter: blur(35px) saturate(220%) brightness(105%);
        -webkit-backdrop-filter: blur(35px) saturate(220%) brightness(105%);
        box-shadow: 
            0 4px 20px rgba(0,0,0,0.12),
            inset 0 1px 0 0 rgba(255, 255, 255, 0.6);
    }
    
    .navbar-brand {
        font-family: 'Montserrat', sans-serif;
        font-weight: 700;
        font-size: 1.8rem;
        color: var(--primary-red) !important;
        display: flex;
        align-items: center;
    }
    
    .navbar-brand i {
        color: var(--primary-orange);
        margin-right: 10px;
    }
    
    .nav-link {
        font-weight: 500;
        padding: 0.5rem 1rem !important;
        color: #555 !important;
        transition: all 0.3s;
        margin: 0.5px;
    }
    
    .nav-link:hover, .nav-link.active {
        color: var(--primary-red) !important;
    }
    
    /* NAVBAR TOGGLER - FIX */
    .navbar-toggler {
        border: 2px solid var(--primary-red);
        padding: 8px 12px;
        border-radius: 5px;
        transition: all 0.3s;
        background-color: transparent;
    }
    
    .navbar-toggler-icon {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='%23DC3545' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e") !important;
        width: 1.5em;
        height: 1.5em;
    }
    
    .navbar-toggler:focus {
        box-shadow: 0 0 0 3px rgba(220, 53, 69, 0.25);
        outline: none;
    }
    
    .navbar-toggler:hover {
        background-color: rgba(220, 53, 69, 0.1);
    }
    
    .cart-icon {
        position: relative;
        font-size: 1.3rem;
        color: var(--dark-brown);
    }
    
    .cart-badge {
        position: absolute;
        top: -8px;
        right: -8px;
        background: var(--primary-red);
        color: white;
        border-radius: 50%;
        width: 20px;
        height: 20px;
        font-size: 0.75rem;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    /* BUTTONS */
    .btn-primary-custom {
        background: linear-gradient(135deg, var(--primary-red), var(--primary-orange));
        border: none;
        color: white;
        padding: 10px 25px;
        border-radius: 50px;
        font-weight: 600;
        transition: all 0.3s;
        box-shadow: 0 4px 15px rgba(220, 53, 69, 0.3);
    }
    
    .btn-primary-custom:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 20px rgba(220, 53, 69, 0.4);
        color: white;
    }
    
    .btn-outline-custom {
        border: 2px solid var(--primary-red);
        color: var(--primary-red);
        background: transparent;
        padding: 8px 20px;
        border-radius: 50px;
        font-weight: 600;
        transition: all 0.3s;
    }
    
    .btn-outline-custom:hover {
        background: var(--primary-red);
        color: white;
    }
    
    /* HERO SECTION */
    .hero-section {
        background: linear-gradient(rgba(74, 44, 42, 0.9), rgba(74, 44, 42, 0.8)), 
                    url('https://images.unsplash.com/photo-1621996346565-e3dbc353d2e5?ixlib=rb-4.0.3&auto=format&fit=crop&w=2080&q=80');
        background-size: cover;
        background-position: center;
        color: white;
        padding: 120px 0;
        position: relative;
        overflow: hidden;
    }
    
    .hero-title {
        font-family: 'Montserrat', sans-serif;
        font-size: 3.5rem;
        font-weight: 700;
        margin-bottom: 20px;
        line-height: 1.2;
    }
    
    .hero-subtitle {
        font-size: 1.2rem;
        margin-bottom: 30px;
        opacity: 0.9;
    }
    
    /* PRODUCT CARDS */
    .product-card {
        border: none;
        border-radius: 15px;
        overflow: hidden;
        background: white;
        box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        transition: all 0.3s ease;
        height: 100%;
    }
    
    .product-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.15);
    }
    
    .product-img {
        height: 200px;
        object-fit: cover;
        width: 100%;
    }
    
    .product-title {
        font-weight: 600;
        color: var(--dark-brown);
        margin-bottom: 10px;
    }
    
    .product-price {
        color: var(--primary-red);
        font-weight: 700;
        font-size: 1.2rem;
    }
    
    .badge-category {
        background: var(--accent-yellow);
        color: var(--dark-brown);
        font-size: 0.8rem;
        padding: 5px 10px;
        border-radius: 20px;
    }
    
    /* FOOTER */
    .main-footer {
        background-color: var(--dark-brown);
        color: white;
        padding: 60px 0 20px;
    }
    
    .footer-title {
        font-family: 'Montserrat', sans-serif;
        font-size: 1.5rem;
        margin-bottom: 20px;
        color: white;
    }
    
    .footer-links a {
        color: rgba(255,255,255,0.7);
        text-decoration: none;
        display: block;
        margin-bottom: 10px;
        transition: color 0.3s;
    }
    
    .footer-links a:hover {
        color: var(--accent-yellow);
    }
    
    .social-icons a {
        display: inline-block;
        width: 40px;
        height: 40px;
        background: rgba(255,255,255,0.1);
        border-radius: 50%;
        text-align: center;
        line-height: 40px;
        margin-right: 10px;
        color: white;
        transition: all 0.3s;
    }
    
    .social-icons a:hover {
        background: var(--primary-red);
        transform: translateY(-3px);
    }
    
    .copyright {
        border-top: 1px solid rgba(255,255,255,0.1);
        padding-top: 20px;
        margin-top: 40px;
        text-align: center;
        color: rgba(255,255,255,0.6);
        font-size: 0.9rem;
    }
    
    /* UTILITIES */
    .section-title {
        font-family: 'Montserrat', sans-serif;
        font-size: 2.5rem;
        font-weight: 700;
        color: var(--dark-brown);
        margin-bottom: 15px;
        text-align: center;
    }
    
    .section-subtitle {
        color: #666;
        text-align: center;
        margin-bottom: 50px;
        font-size: 1.1rem;
    }
    
    /* RESPONSIVE */
    @media (max-width: 768px) {
        .hero-title {
            font-size: 2.5rem;
        }
        
        .section-title {
            font-size: 2rem;
        }
        
        .navbar-brand {
            font-size: 1.5rem;
        }
        
        /* Mobile menu improvements */
        .navbar-collapse {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            margin-top: 10px;
        }
        
        .dropdown-menu {
            border: none;
            box-shadow: none;
            background: var(--light-gray);
        }
    }

    /* ========== CART PAGE STYLES ========== */
.min-vh-40 {
    min-height: 40vh;
}

.min-vh-50 {
    min-height: 50vh;
}

.min-vh-60 {
    min-height: 60vh;
}

.table th {
    font-weight: 600;
    color: var(--dark-brown);
}

.table td {
    vertical-align: middle;
}

.sticky-top {
    z-index: 1020;
}

input[type="number"]::-webkit-inner-spin-button,
input[type="number"]::-webkit-outer-spin-button {
    -webkit-appearance: none;
    margin: 0;
}


.cart-button {
    transition: all 0.3s;
}

.cart-button:hover {
    transform: scale(1.1);
}

/* ========== PRODUCT CARD HOVER EFFECT ========== */
.product-card {
    transition: all 0.3s ease;
    border-radius: 15px;
    overflow: hidden;
}

.product-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 30px rgba(220, 53, 69, 0.15);
}

.product-image-container {
    position: relative;
}

.product-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(to bottom, transparent 50%, rgba(0,0,0,0.7));
    opacity: 0;
    transition: opacity 0.3s;
}

.product-card:hover .product-overlay {
    opacity: 1;
}

.object-fit-cover {
    object-fit: cover;
}

/* ========== CATEGORY CARD ========== */
.category-card {
    transition: all 0.3s ease;
    border-radius: 15px;
    overflow: hidden;
}

.category-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(220, 53, 69, 0.1);
}

.category-card:hover .icon-wrapper {
    transform: scale(1.1);
}

/* ========== CONTACT CARD ========== */
.contact-card {
    transition: all 0.3s ease;
    border-radius: 15px;
    overflow: hidden;
}

.contact-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(220, 53, 69, 0.1);
}

.contact-card:hover .icon-wrapper {
    transform: scale(1.1);
}

/* ========== ICON WRAPPER ========== */
.icon-wrapper {
    transition: transform 0.3s;
}

.card:hover .icon-wrapper {
    transform: scale(1.1);
}

/* ========== FORM STYLES ========== */
.form-floating > .form-control,
.form-floating > .form-control-plaintext {
    border-left: 3px solid #dc3545;
}

.form-floating > .form-control:focus,
.form-floating > .form-control-plaintext:focus {
    border-color: #dc3545;
    box-shadow: 0 0 0 0.25rem rgba(220, 53, 69, 0.25);
}

/* ========== GLASSMORPHISM UTILITIES (iOS Style) ========== */
.glass-card {
    background: rgba(255, 255, 255, 0.45) !important;
    backdrop-filter: blur(20px) saturate(180%) !important;
    -webkit-backdrop-filter: blur(20px) saturate(180%) !important;
    border: 1px solid rgba(255, 255, 255, 0.3) !important;
    border-radius: 20px !important;
    box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.1) !important;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1) !important;
}

.glass-card:hover {
    background: rgba(255, 255, 255, 0.55) !important;
    transform: translateY(-8px);
    box-shadow: 0 12px 40px 0 rgba(31, 38, 135, 0.15) !important;
}

.glass-btn {
    background: rgba(255, 255, 255, 0.25) !important;
    backdrop-filter: blur(15px) saturate(160%) !important;
    -webkit-backdrop-filter: blur(15px) saturate(160%) !important;
    border: 1px solid rgba(255, 255, 255, 0.4) !important;
    color: white !important;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1) !important;
    border-radius: 12px !important;
    font-weight: 600 !important;
    transition: all 0.3s ease !important;
}

.glass-btn:hover {
    background: rgba(255, 255, 255, 0.35) !important;
    transform: scale(1.05);
    color: white !important;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15) !important;
}

.glass-btn-dark {
    background: rgba(0, 0, 0, 0.2) !important;
    backdrop-filter: blur(15px) saturate(160%) !important;
    -webkit-backdrop-filter: blur(15px) saturate(160%) !important;
    border: 1px solid rgba(255, 255, 255, 0.1) !important;
    color: white !important;
    border-radius: 12px !important;
}


.glass-btn-danger {
    background: rgba(220, 53, 69, 0.8) !important;
    backdrop-filter: blur(10px) !important;
    -webkit-backdrop-filter: blur(10px) !important;
    border: 1px solid rgba(255, 255, 255, 0.2) !important;
    color: white !important;
    border-radius: 12px !important;
    transition: all 0.3s ease !important;
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    padding: 10px 24px !important;
    text-decoration: none !important;
}

    .glass-btn-danger:hover {
        background: rgba(220, 53, 69, 1) !important;
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(220, 53, 69, 0.3) !important;
        color: white !important;
    }

    /* RESPONSIVE DESIGN (MOBILE FIRST ENHANCEMENTS) */
    @media (max-width: 768px) {
        .display-4 {
            font-size: 2.2rem;
        }
        
        .hero-section {
            padding: 60px 0;
            text-align: center;
        }
        
        .min-vh-80 {
            min-height: auto;
            padding-bottom: 30px;
        }
        
        .hero-section .d-flex {
            justify-content: center;
        }
        
        /* Product Card Mobile Tweaks */
        .product-card .card-body {
            padding: 1.25rem !important;
        }
        
        .product-card .card-title {
            font-size: 1.1rem;
        }
        
        /* Cart Table Mobile Optimization */
        .cart-table-responsive tbody tr {
            display: block;
            border-bottom: 2px solid #f8f9fa;
            padding: 1rem 0;
        }
        
        .cart-table-responsive td {
            display: block;
            text-align: left;
            border: none;
            padding: 0.5rem 1rem;
        }
        
        .cart-table-responsive .mobile-label {
            font-size: 0.75rem;
            font-weight: 600;
            color: #999;
            text-transform: uppercase;
            display: block;
            margin-bottom: 2px;
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
    // Global function to auto-hide toasts
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

    document.addEventListener('DOMContentLoaded', setupToastAutoClear);
    
    if (typeof MutationObserver !== 'undefined') {
        const observer = new MutationObserver(setupToastAutoClear);
        document.addEventListener('DOMContentLoaded', () => {
            const container = document.getElementById('toast-container');
            if (container) {
                observer.observe(container, { childList: true });
            }
        });
    }
</script>

@stack('styles') <!-- Untuk styles tambahan per halaman -->
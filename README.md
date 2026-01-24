#  Pangsit Chili Oil - E-Commerce Platform



---

## 🎯 Tentang Project

Project ini adalah sistem e-commerce untuk **Pangsit Chili Oil** yang dibangun menggunakan Laravel 11. Sistem ini memiliki dua interface utama:
- **Frontend**: Interface untuk customer (katalog produk, keranjang, checkout)
- **Admin Panel**: Interface untuk admin (manajemen produk, kategori, pesanan)

**Mata Kuliah**: MPPL & PBKK  
**Tahun**: 2025

---

##  Fitur Utama

###  Frontend (Customer)
- ✅ Homepage dengan hero section
- ✅ Katalog produk dengan filter kategori
- ✅ Detail produk
- ✅ Keranjang belanja (Cart) dengan AJAX
- ✅ Checkout & Pembayaran
- ✅ Autentikasi (Login/Register)
- ✅ Profil pelanggan
- ✅ Riwayat pesanan
- ✅ Navbar dengan Glassmorphism Effect

###  Admin Panel
- ✅ Dashboard admin
- ✅ Manajemen Produk (CRUD)
- ✅ Manajemen Kategori (CRUD)
- ✅ Manajemen Pelanggan
- ✅ Monitoring Pesanan
- ✅ Quick access icons

---
### Teknologi

| Kategori | Teknologi |
|----------|-----------|
| **Backend** | Laravel 11.x |
| **Frontend** | Blade Templates, Bootstrap 5 |
| **Database** | SQLite |
| **Authentication** | Laravel Auth |
| **Package Manager** | Composer |
| **CSS Framework** | Bootstrap 5 + Custom CSS |
| **Icons** | Font Awesome |
| **Fonts** | Google Fonts (Poppins, Montserrat) |

---

## 📁 Struktur Folder

pangsit_chili_oil/
├── app/
│   ├── Http/Controllers/      # Logic aplikasi
│   │   ├── AdminController.php
│   │   ├── AuthController.php
│   │   ├── CartController.php
│   │   ├── FrontendController.php
│   │   ├── KategoriController.php
│   │   ├── ProdukController.php
│   │   └── ...
│   └── Models/                 # Database models
│       ├── Produk.php
│       ├── Kategori.php
│       ├── Pesanan.php
│       └── ...
├── database/
│   ├── migrations/             # Database schema
│   └── seeders/                # Data awal
├── resources/views/
│   ├── frontend/               # Tampilan customer
│   │   ├── pages/              # Halaman utama
│   │   ├── partials/           # Components (header, footer)
│   │   ├── includes/           # Styles & scripts
│   │   └── products/           # Product views
│   └── admin/                  # Tampilan admin
├── routes/
│   └── web.php                 # Route definitions
└── public/                     # Public assets
```


### Admin
- **Email**: admin@pangsitchilioil.com
- **Password**: admin123

### Customer (Testing)
- **Email**: customer@example.com
- **Password**: password


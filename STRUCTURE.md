# 📁 Struktur Folder Project Pangsit Chili Oil

Dokumentasi lengkap struktur folder project Laravel untuk memudahkan pemahaman dan navigasi.

---

## 🎯 Struktur Utama Project

```
pangsit_chili_oil/
├── 📂 app/                    # Logika aplikasi (MVC Core)
├── 📂 bootstrap/              # File bootloader Laravel
├── 📂 config/                 # Konfigurasi aplikasi
├── 📂 database/               # Database, migrations, seeders
├── 📂 public/                 # Entry point & assets publik
├── 📂 resources/              # Views, CSS, JS (frontend)
├── 📂 routes/                 # Route definitions
├── 📂 storage/                # File storage & logs
├── 📂 tests/                  # Unit & feature tests
├── 📂 vendor/                 # Dependencies (composer)
├── 📄 .env                    # Environment variables
├── 📄 artisan                 # CLI Laravel
├── 📄 composer.json           # PHP dependencies
└── 📄 README.md               # Dokumentasi project
```

---

## 📦 Detail Folder Penting

### 1️⃣ **`app/` - Application Core**

Folder ini berisi **logika bisnis** aplikasi.

```
app/
├── Console/                   # Custom Artisan commands
├── Http/
│   ├── Controllers/           # ⭐ Controllers (MVC)
│   │   ├── AdminController.php          # Admin dashboard
│   │   ├── AuthController.php           # Login/Register
│   │   ├── CartController.php           # Keranjang belanja
│   │   ├── DashboardController.php      # Dashboard pelanggan
│   │   ├── FrontendController.php       # Halaman frontend
│   │   ├── KategoriController.php       # Manajemen kategori
│   │   ├── PelangganController.php      # Manajemen pelanggan
│   │   ├── ProdukController.php         # Manajemen produk
│   │   └── ProfilController.php         # User profile
│   └── Middleware/            # Request filters
├── Models/                    # ⭐ Models (MVC)
│   ├── Admin.php              # Model Admin
│   ├── ItemPesanan.php        # Model Item Pesanan
│   ├── Kategori.php           # Model Kategori
│   ├── Pelanggan.php          # Model Pelanggan
│   ├── Pesanan.php            # Model Pesanan
│   ├── Produk.php             # Model Produk
│   └── User.php               # Model User (Auth)
└── Providers/                 # Service providers
```

> 💡 **Tip**: Controllers menangani request, Models berinteraksi dengan database

---

### 2️⃣ **`resources/views/` - Views (Frontend)**

Folder ini berisi **tampilan (Blade templates)**.

```
resources/views/
├── admin/                     # ⭐ Admin Panel Views
│   ├── index.blade.php        # Dashboard admin
│   ├── show.blade.php         # Detail view admin
│   └── ...
├── dashboard/                 # Dashboard pelanggan
│   └── index.blade.php
├── frontend/                  # ⭐ Public-Facing Website
│   ├── auth/                  # Login & Register pages
│   │   ├── login.blade.php
│   │   └── register.blade.php
│   ├── cart/                  # Shopping cart
│   │   └── index.blade.php
│   ├── includes/              # Reusable components
│   │   ├── cart-script.blade.php    # Cart JS logic
│   │   ├── meta.blade.php           # HTML meta tags
│   │   ├── scripts.blade.php        # JS imports
│   │   └── styles.blade.php         # ⭐ CSS styles (navbar glass effect)
│   ├── layouts/               # Master layouts
│   │   └── front.blade.php          # Main layout template
│   ├── pages/                 # Static pages
│   │   ├── about.blade.php          # Tentang
│   │   ├── contact.blade.php        # Kontak
│   │   └── home.blade.php           # Homepage
│   ├── partials/              # Page sections
│   │   ├── footer.blade.php         # Footer component
│   │   ├── header.blade.php         # ⭐ Navbar component
│   │   └── ...
│   └── products/              # Product pages
│       ├── index.blade.php          # Product list
│       └── show.blade.php           # Product detail
├── kategori/                  # Admin kategori management
├── pelanggan/                 # Admin pelanggan management
├── produk/                    # Admin produk management
└── layouts/                   # Global layouts
    └── app.blade.php
```

> 💡 **Tip**: 
> - `frontend/` = Halaman yang dilihat customer
> - `admin/` = Halaman admin panel
> - `includes/` = Component reusable (navbar, footer, dll)

---

### 3️⃣ **`database/` - Database Layer**

Folder untuk **struktur database** dan data seed.

```
database/
├── factories/                 # Model factories (testing)
├── migrations/                # ⭐ Database schema
│   ├── 0001_01_01_000000_create_users_table.php
│   ├── 2025_01_07_create_admins_table.php
│   ├── 2025_01_07_create_kategoris_table.php
│   ├── 2025_01_07_create_produks_table.php
│   ├── 2025_01_07_create_pelanggans_table.php
│   ├── 2025_01_07_create_pesanans_table.php
│   └── 2025_01_07_create_item_pesanans_table.php
├── seeders/                   # ⭐ Sample data
│   ├── AdminSeeder.php        # Data admin default
│   ├── KategoriSeeder.php     # Data kategori
│   ├── ProdukSeeder.php       # Data produk
│   └── UserSeeder.php         # Data user
└── database.sqlite            # SQLite database file
```

> 💡 **Tip**: Migrations untuk struktur tabel, Seeders untuk data awal

---

### 4️⃣ **`routes/` - URL Routes**

Definisi **URL dan routing** aplikasi.

```
routes/
├── web.php                    # ⭐ Web routes (semua URL ada di sini)
└── console.php                # Artisan commands
```

> 💡 **Tip**: File `web.php` ini penting! Semua URL mapping ada di sini

---

### 5️⃣ **`public/` - Public Assets**

Folder **publik** yang bisa diakses browser.

```
public/
├── index.php                  # Entry point aplikasi
├── css/                       # Custom CSS files
├── js/                        # Custom JS files
└── images/                    # Upload images
```

> 💡 **Tip**: Semua request masuk melalui `index.php`

---

### 6️⃣ **`storage/` - File Storage**

Folder untuk **file yang di-generate** aplikasi.

```
storage/
├── app/                       # File aplikasi
│   └── public/                # File publik (symlink ke public/storage)
├── framework/                 # Cache, sessions, views
├── logs/                      # ⭐ Log files (cek error di sini!)
└── ...
```

> 💡 **Tip**: Cek `storage/logs/laravel.log` untuk debugging error

---

## 🎨 Struktur MVC Explanation

Laravel menggunakan pola **MVC (Model-View-Controller)**:

```
┌─────────────────────────────────────────────────┐
│                   USER REQUEST                  │
│              (misal: /produk/1)                 │
└───────────────────┬─────────────────────────────┘
                    │
                    ▼
        ┌───────────────────────┐
        │   routes/web.php      │ ← Define URL → Controller
        └───────────┬───────────┘
                    │
                    ▼
        ┌──────────────────────────────┐
        │  app/Http/Controllers/       │
        │  ProdukController.php        │ ← Logic & Data Processing
        └───────────┬──────────────────┘
                    │
        ┌───────────┴──────────────┐
        ▼                          ▼
┌──────────────┐          ┌──────────────────┐
│ app/Models/  │          │ resources/views/ │
│ Produk.php   │ ← DB ←   │ frontend/        │ ← Display HTML
└──────────────┘          │ products/        │
                          │ show.blade.php   │
                          └──────────────────┘
```

### Flow Sederhana:

1. **User** akses URL → `/produk/1`
2. **Router** (`routes/web.php`) → arahkan ke `ProdukController@show`
3. **Controller** → ambil data dari Model `Produk`
4. **Model** → query database, return data
5. **Controller** → kirim data ke View
6. **View** (`products/show.blade.php`) → render HTML
7. **Response** → tampilkan ke browser user

---

## 🔍 File-File Penting

| File | Fungsi |
|------|--------|
| `.env` | Environment config (database, app key, dll) |
| `routes/web.php` | Definisi semua URL aplikasi |
| `app/Http/Controllers/` | Logic handler untuk setiap fitur |
| `app/Models/` | Interaksi dengan database |
| `resources/views/frontend/` | Tampilan untuk customer |
| `resources/views/admin/` | Tampilan untuk admin |
| `database/migrations/` | Struktur database |
| `database/seeders/` | Data awal/testing |
| `storage/logs/laravel.log` | **Error logs untuk debugging!** |

---

## 🚀 Quick Navigation Guide

### Untuk Edit **Tampilan (UI)**:
```
➡ resources/views/frontend/
```

### Untuk Edit **Logic/Fungsi**:
```
➡ app/Http/Controllers/
```

### Untuk Edit **Database Schema**:
```
➡ database/migrations/
```

### Untuk Edit **Routing (URL)**:
```
➡ routes/web.php
```

### Untuk Edit **Styling (CSS)**:
```
➡ resources/views/frontend/includes/styles.blade.php
```

### Untuk Cek **Error**:
```
➡ storage/logs/laravel.log
```

---

## 📌 Catatan Tambahan

### ✅ Best Practices:
- Jangan edit file di folder `vendor/` (auto-generated)
- Backup file `.env` (jangan di-commit ke Git!)
- Gunakan migrations untuk perubahan database
- Gunakan seeders untuk data testing

### 🔧 Command Berguna:
```bash
# Clear cache
php artisan cache:clear
php artisan view:clear
php artisan config:clear

# Database
php artisan migrate              # Run migrations
php artisan db:seed              # Run seeders
php artisan migrate:fresh --seed # Reset & seed

# Development
php artisan serve                # Run local server
php artisan route:list           # Lihat semua routes
```

---

**Dokumentasi dibuat**: 2026-01-20
**Project**: Pangsit Chili Oil E-Commerce
**Framework**: Laravel 11.x

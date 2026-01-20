# 🌶️ Pangsit Chili Oil - E-Commerce Platform

Platform e-commerce untuk penjualan Pangsit Chili Oil dengan sistem admin panel dan keranjang belanja.

![Laravel](https://img.shields.io/badge/Laravel-11.x-red?logo=laravel)
![PHP](https://img.shields.io/badge/PHP-8.x-blue?logo=php)
![SQLite](https://img.shields.io/badge/Database-SQLite-green?logo=sqlite)

---

## 📋 Daftar Isi

- [Tentang Project](#-tentang-project)
- [Fitur Utama](#-fitur-utama)
- [Teknologi](#-teknologi)
- [Struktur Folder](#-struktur-folder)
- [Instalasi](#-instalasi)
- [Penggunaan](#-penggunaan)
- [Dokumentasi](#-dokumentasi)

---

## 🎯 Tentang Project

Project ini adalah sistem e-commerce untuk **Pangsit Chili Oil** yang dibangun menggunakan Laravel 11. Sistem ini memiliki dua interface utama:
- **Frontend**: Interface untuk customer (katalog produk, keranjang, checkout)
- **Admin Panel**: Interface untuk admin (manajemen produk, kategori, pesanan)

**Mata Kuliah**: MPPL & PBKK  
**Tahun**: 2025

---

## ✨ Fitur Utama

### 🛒 Frontend (Customer)
- ✅ Homepage dengan hero section
- ✅ Katalog produk dengan filter kategori
- ✅ Detail produk
- ✅ Keranjang belanja (Cart) dengan AJAX
- ✅ Checkout & Pembayaran
- ✅ Autentikasi (Login/Register)
- ✅ Profil pelanggan
- ✅ Riwayat pesanan
- ✅ **Navbar dengan Glassmorphism Effect** 🎨

### 🔧 Admin Panel
- ✅ Dashboard admin
- ✅ Manajemen Produk (CRUD)
- ✅ Manajemen Kategori (CRUD)
- ✅ Manajemen Pelanggan
- ✅ Monitoring Pesanan
- ✅ Quick access icons

---

## 🛠️ Teknologi

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

Struktur folder mengikuti **pola MVC Laravel**:

```
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

> 📚 **Dokumentasi lengkap**: Lihat file [`STRUCTURE.md`](./STRUCTURE.md) untuk penjelasan detail struktur folder

---

## 🚀 Instalasi

### Prasyarat
- PHP >= 8.1
- Composer
- SQLite (atau MySQL/PostgreSQL)

### Langkah-Langkah

1. **Clone repository**
   ```bash
   git clone <repository-url>
   cd pangsit_chili_oil
   ```

2. **Install dependencies**
   ```bash
   composer install
   ```

3. **Copy file environment**
   ```bash
   copy .env.example .env
   ```

4. **Generate application key**
   ```bash
   php artisan key:generate
   ```

5. **Setup database**
   
   Buat file database SQLite:
   ```bash
   touch database/database.sqlite
   ```
   
   Edit `.env`:
   ```env
   DB_CONNECTION=sqlite
   DB_DATABASE=C:\path\to\database\database.sqlite
   ```

6. **Run migrations & seeders**
   ```bash
   php artisan migrate:fresh --seed
   ```

7. **Run development server**
   ```bash
   php artisan serve
   ```

8. **Akses aplikasi**
   - Frontend: http://localhost:8000
   - Admin Panel: http://localhost:8000/admin

---

## 👤 Default Credentials

Setelah menjalankan seeder, gunakan kredensial berikut:

### Admin
- **Email**: admin@pangsitchilioil.com
- **Password**: admin123

### Customer (Testing)
- **Email**: customer@example.com
- **Password**: password

> 📝 **Catatan**: Lihat file `CREDENTIALS.md` untuk kredensial lengkap

---

## 📖 Penggunaan

### Menjalankan Server
```bash
php artisan serve
```

### Clear Cache
```bash
php artisan cache:clear
php artisan view:clear
php artisan config:clear
```

### Reset Database
```bash
php artisan migrate:fresh --seed
```

### Lihat Semua Routes
```bash
php artisan route:list
```

---

## 📚 Dokumentasi

| File | Deskripsi |
|------|-----------|
| `CREDENTIALS.md` | Kredensial login untuk testing |
| `STRUCTURE.md` | Dokumentasi lengkap struktur folder |
| `.env.example` | Template environment variables |

---

## 🎨 Fitur CSS Kustom

- **Glassmorphism Navbar**: Background transparan dengan blur effect
- **Gradient Buttons**: Tombol dengan gradient merah-orange
- **Hover Animations**: Animasi smooth pada cards dan buttons
- **Responsive Design**: Mobile-friendly layout
- **Custom Color Scheme**: Red-Orange-Yellow theme

---

## 🛡️ Security

- Authentication menggunakan Laravel default
- CSRF protection pada semua form
- Password hashing dengan bcrypt
- XSS protection
- SQL injection prevention (Eloquent ORM)

---

## 📞 Kontak & Support

Jika ada pertanyaan atau issue:
1. Cek dokumentasi di folder `docs/`
2. Lihat `storage/logs/laravel.log` untuk error
3. Contact developer team

---

## 📝 License

Project ini dibuat untuk keperluan **tugas kuliah MPPL & PBKK**.

---

## 🙏 Credits

- **Framework**: [Laravel](https://laravel.com)
- **CSS Framework**: [Bootstrap 5](https://getbootstrap.com)
- **Icons**: [Font Awesome](https://fontawesome.com)
- **Fonts**: [Google Fonts](https://fonts.google.com)

---

**Dibuat dengan ❤️ untuk tugas MPPL & PBKK**

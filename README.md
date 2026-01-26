# 🥟 Pangsit Chili Oil - E-Commerce Platform

Sistem manajemen e-commerce untuk bisnis **Pangsit Chili Oil**, dirancang untuk memberikan pengalaman belanja yang mulus bagi pelanggan dan kemudahan operasional bagi admin. Dibangun menggunakan framework **Laravel 11** dengan arsitektur modern.

---

## 🚀 Fitur Utama

### 🛒 Frontend (Pelanggan)
- **Katalog Produk:** Penampilan menu yang interaktif dengan filter kategori.
- **Shopping Cart:** Sistem keranjang yang responsif berbasis AJAX.
- **WhatsApp Integration:** Checkout otomatis yang diarahkan langsung ke WhatsApp dengan rincian pesanan.
- **Account Management:** Registrasi, login, dan manajemen profil pelanggan.
- **Order History:** Pantau status dan riwayat pesanan dengan mudah.
- **Modern UI:** Desain minimalis dengan sentuhan Glassmorphism.

### ⚙️ Admin Dashboard
- **Analytics:** Pantau total penjualan, stok barang, dan pengeluaran operasional.
- **Product Management:** CRUD lengkap untuk produk (Nama, Deskripsi, Harga, Stok, & Unggah Gambar).
- **Category Management:** Organisasi menu berdasarkan kategori custom.
- **Staff Management:** Kelola akun Admin dan Kasir (Role-based access).
- **Sales Reporting:** Monitoring transaksi masuk dan update status pesanan.
- **Expense Tracking:** Catat pengeluaran bahan baku dan biaya operasional lainnya.

---

## 🛠 Tech Stack

| Komponen | Teknologi |
| :--- | :--- |
| **Backend** | Laravel 11.x (PHP 8.2+) |
| **Frontend** | Blade Engine, Bootstrap 5, Custom CSS |
| **Database** | SQLite / MySQL |
| **Auth** | Laravel Sanctum / Session-based |
| **Styling** | Google Fonts (Plus Jakarta Sans), Font Awesome 6 |

---


---

## 👤 Akun Percobaan

| Role | Email | Password |
| :--- | :--- | :--- |
| **Admin** | `admin@pangsitchilioil.com` | `admin123` |
| **Customer** | `customer@example.com` | `password` |

---

## 🏗️ Arsitektur MVC (Model-View-Controller)

Project ini mengikuti pola arsitektur **MVC** standar Laravel untuk memisahkan logika bisnis, data, dan tampilan:

1.  **Model (Data & Logic):** Terletak di `app/Models/`. Mengelola interaksi database dan aturan bisnis.
    *   *Contoh:* `Produk.php` mengelola data makanan, `User.php` mengelola akun staff.
2.  **View (Tampilan):** Terletak di `resources/views/`. Menggunakan *Blade Templating Engine* untuk menampilkan data ke pengguna.
    *   *Contoh:* `admin/produk/index.blade.php` menampilkan daftar stok barang.
3.  **Controller (Penghubung):** Terletak di `app/Http/Controllers/`. Menerima request dari user, mengambil data dari Model, dan mengirimkannya ke View.
    *   *Contoh:* `CartController.php` memproses logika penambahan item ke keranjang.

---

## 📂 Struktur Folder Lengkap

```text
pangsit_chili_oil/
├── app/
│   ├── Http/Controllers/       # Logika Kendali (Controllers)
│   │   ├── AdminController.php      # Manajemen Staff & Users
│   │   ├── AuthController.php       # Login & Registrasi
│   │   ├── CartController.php       # Keranjang & Checkout WA
│   │   ├── ProdukController.php     # Manajemen Katalog Produk
│   │   └── LaporanController.php    # Reporting & Status Pesanan
│   ├── Http/Middleware/        # Filter Keamanan (Admin Access)
│   └── Models/                 # Representasi Database (Models)
│       ├── User.php, Produk.php, Kategori.php, Pesanan.php, Pelanggan.php
├── config/                     # Konfigurasi Global Aplikasi
├── database/
│   ├── migrations/             # Skema Tabel Database
│   └── seeders/                # Data Awal (Default Users/Produk)
├── public/                     # File Statis (CSS, JS, Images, Uploads)
├── resources/
│   └── views/                  # File Tampilan (Blade Views)
│       ├── admin/              # Panel Manajemen (Dashboard, Produk, dll)
│       ├── frontend/           # Interface Customer (Home, Shop, Cart)
│       └── layouts/            # Template Induk (Admin & Front)
├── routes/
│   └── web.php                 # Definisi URL/Routing
└── .env                        # Konfigurasi Environment & Database
```

---

## 📝 Informasi Akademik
- **Mata Kuliah:** MPPL & PBKK (Proyek Pengembangan Perangkat Lunak)
- **Tahun Anggaran:** 2025/2026
- **Status Project:** Production Ready



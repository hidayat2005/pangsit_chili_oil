# Kredensial Login - Pangsit Chili Oil

## Dashboard Admin & Kasir

### 🔐 Akun Admin
- **URL Login**: http://127.0.0.1:8000/login
- **Email**: `admin@pangsit.com`
- **Password**: `admin123`
- **Role**: Admin (Akses penuh ke semua fitur)

### 🔐 Akun Kasir
- **URL Login**: http://127.0.0.1:8000/login
- **Email**: `kasir@pangsit.com`
- **Password**: `kasir123`
- **Role**: Kasir (Akses ke fitur kasir)

### 🔐 Akun Customer (Testing)
- **URL Login**: http://127.0.0.1:8000/login
- **Email**: `customer@test.com`
- **Password**: `customer123`
- **Role**: Customer (Akses halaman frontend)

---

## Cara Login

1. **Buka browser** dan navigasi ke: http://127.0.0.1:8000/login
2. **Masukkan email dan password** sesuai kredensial di atas
3. **Click tombol "Login"**
4. Anda akan diarahkan ke dashboard sesuai role:
   - **Admin/Kasir** → Dashboard Admin (`/admin/dashboard`)
   - **Customer** → Halaman Home Frontend (`/`)

---

## Akses Dashboard Admin

Setelah login sebagai admin, Anda dapat mengakses:

- **Dashboard**: http://127.0.0.1:8000/admin/dashboard
- **Kelola Produk**: http://127.0.0.1:8000/admin/produk
- **Kelola Kategori**: http://127.0.0.1:8000/admin/kategori
- **Kelola User/Kasir**: http://127.0.0.1:8000/admin/users
- **Lihat Pelanggan**: http://127.0.0.1:8000/admin/pelanggan

---

## Reset Password (Jika Lupa)

Jika Anda lupa password atau ingin membuat akun admin baru, jalankan:

```bash
php artisan db:seed --class=UserSeeder
```

**CATATAN**: Perintah ini akan membuat ulang akun admin, kasir, dan customer dengan password default di atas.

---

## Troubleshooting

### Tidak bisa login?
1. Pastikan database sudah di-migrate: `php artisan migrate`
2. Pastikan seeder sudah dijalankan: `php artisan db:seed --class=UserSeeder`
3. Pastikan server Laravel berjalan: `php artisan serve`
4. Clear cache jika perlu: `php artisan cache:clear`

### Lupa menjalankan seeder?
Jalankan perintah berikut untuk membuat akun admin:
```bash
php artisan db:seed --class=UserSeeder
```

---

## Keamanan

⚠️ **PENTING untuk Production**:
- Ganti password default dengan password yang kuat
- Jangan gunakan kredensial ini di environment production
- Hapus atau nonaktifkan akun test customer
- Enable two-factor authentication jika memungkinkan

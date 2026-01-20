---
description: Development server startup workflow
---

# Start Development Server

Workflow untuk menjalankan development server dengan setup lengkap.

## Steps:

// turbo
1. **Clear all cache terlebih dahulu**
```bash
php artisan optimize:clear
```

// turbo
2. **Clear view cache**
```bash
php artisan view:clear
```

3. **Start Laravel development server**
```bash
php artisan serve
```

Server akan running di: http://localhost:8000

## Access Points:

### Frontend
- Homepage: http://localhost:8000
- Products: http://localhost:8000/produk
- Cart: http://localhost:8000/cart
- Login: http://localhost:8000/login

### Admin Panel
- Dashboard: http://localhost:8000/admin
- Products: http://localhost:8000/admin/produk
- Categories: http://localhost:8000/admin/kategori

## Default Credentials:
- **Admin**: admin@pangsitchilioil.com / admin123
- **Customer**: customer@example.com / password

## Troubleshooting:
- Port sudah dipakai? Gunakan: `php artisan serve --port=8001`
- Error? Cek: `storage/logs/laravel.log`

---
description: Reset database dan jalankan seeders untuk development
---

# Reset Database Workflow

Workflow untuk reset database dan populate dengan data fresh.

## Steps:

1. **Stop server jika running** (optional)

2. **Reset database dengan migrations fresh**
```bash
php artisan migrate:fresh
```

3. **Run seeders untuk populate data**
```bash
php artisan db:seed
```

// turbo
4. **Clear all cache**
```bash
php artisan optimize:clear
```

5. **Verify dengan tinker (optional)**
```bash
php artisan tinker
# Cek data: User::count()
# Produk::count()
```

## Expected Result:
- Database ter-reset dengan struktur terbaru
- Data seeder ter-populate
- Cache ter-clear
- Siap untuk development

## Credentials:
After seeding, gunakan:
- Admin: admin@pangsitchilioil.com / admin123
- Customer: customer@example.com / password

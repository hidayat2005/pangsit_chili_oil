---
description: Debug errors and check logs
---

# Debugging Workflow

Workflow untuk debugging error dalam aplikasi.

## Steps:

### 1. Check Laravel Log
```bash
# Windows
type storage\logs\laravel.log | Select-Object -Last 50

# Atau buka file langsung
# storage/logs/laravel.log
```

### 2. Enable Debug Mode
Edit `.env`:
```env
APP_DEBUG=true
LOG_LEVEL=debug
```

**PENTING**: Set ke `false` saat production!

// turbo
### 3. Clear All Cache
```bash
php artisan optimize:clear
```

// turbo
### 4. Clear View Cache
```bash
php artisan view:clear
```

// turbo
### 5. Clear Route Cache
```bash
php artisan route:clear
```

// turbo
### 6. Verify Routes
```bash
php artisan route:list
```

### 7. Test Database Connection
```bash
php artisan tinker
# Jalankan: DB::connection()->getPdo();
# Jika berhasil = koneksi OK
```

### 8. Check File Permissions (jika error write)
Pastikan folder ini writable:
- `storage/`
- `bootstrap/cache/`

## Common Errors & Solutions:

### Error: "Class not found"
```bash
composer dump-autoload
```

### Error: "View not found"
```bash
php artisan view:clear
# Cek nama view dan path
```

### Error: "Route not found"
```bash
php artisan route:clear
php artisan route:list
```

### Error: Database connection
```bash
# Cek .env
DB_CONNECTION=sqlite
DB_DATABASE=C:\full\path\to\database.sqlite
```

### Error: "CSRF token mismatch"
```bash
php artisan cache:clear
# Clear browser cookies
```

### Error: "Permission denied"
```bash
# Windows - Run as admin
icacls storage /grant Users:F /t
icacls bootstrap/cache /grant Users:F /t
```

## Useful Debug Commands:

```bash
# Lihat konfigurasi
php artisan config:show

# Lihat environment variables
php artisan env

# Test aplikasi
php artisan test

# Interactive console
php artisan tinker
```

## Debugging Tips:

1. **dd()** - Dump and die
```php
dd($variable); // Debug variable
```

2. **dump()** - Dump without stopping
```php
dump($variable); // Continue execution
```

3. **logger()** - Log to file
```php
logger()->info('Debug message', ['data' => $data]);
```

4. **Ray** - Visual debugger (if installed)
```php
ray($variable);
```

## Log File Location:
`storage/logs/laravel.log`

Check this file first when errors occur!

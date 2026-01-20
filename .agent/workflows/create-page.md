---
description: Create new page in frontend
---

# Create New Frontend Page

Workflow untuk membuat halaman baru di frontend.

## Steps:

### 1. Buat Route
Edit file: `routes/web.php`

Tambahkan:
```php
Route::get('/nama-halaman', [FrontendController::class, 'namaMethod'])->name('nama.route');
```

### 2. Buat Method di Controller
Edit file: `app/Http/Controllers/FrontendController.php`

Tambahkan method:
```php
public function namaMethod()
{
    return view('frontend.pages.nama-halaman');
}
```

### 3. Buat View File
Buat file baru: `resources/views/frontend/pages/nama-halaman.blade.php`

Template:
```blade
@extends('frontend.layouts.front')

@section('content')
<div class="container my-5">
    <h1>Judul Halaman</h1>
    <p>Konten halaman...</p>
</div>
@endsection
```

### 4. (Optional) Tambahkan Link di Navbar
Edit: `resources/views/frontend/partials/header.blade.php`

Tambahkan menu item:
```blade
<li class="nav-item">
    <a class="nav-link" href="{{ route('nama.route') }}">Nama Menu</a>
</li>
```

// turbo
### 5. Clear cache
```bash
php artisan view:clear
```

### 6. Test halaman baru
Akses: http://localhost:8000/nama-halaman

## Contoh Lengkap - Halaman "Promo":

**routes/web.php:**
```php
Route::get('/promo', [FrontendController::class, 'promo'])->name('promo');
```

**FrontendController.php:**
```php
public function promo()
{
    $products = Produk::where('diskon', '>', 0)->get();
    return view('frontend.pages.promo', compact('products'));
}
```

**resources/views/frontend/pages/promo.blade.php:**
```blade
@extends('frontend.layouts.front')

@section('content')
<div class="container my-5">
    <h1 class="section-title">Produk Promo</h1>
    <div class="row">
        @foreach($products as $product)
            <!-- Product card -->
        @endforeach
    </div>
</div>
@endsection
```

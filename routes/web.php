<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FrontendController;

// =============== FRONTEND ROUTES ===============
Route::get('/', function () {
    $products = \App\Models\Produk::latest()->take(6)->get();
    $categories = \App\Models\Kategori::all();
    return view('frontend.pages.home', compact('products', 'categories'));
})->name('home');

// Product Routes - Using FrontendController
Route::get('/produk-front', [FrontendController::class, 'products'])->name('front.products');
Route::get('/produk/{id}', [FrontendController::class, 'productShow'])->name('front.product.show');
Route::get('/kategori/{id}/produk', [FrontendController::class, 'productsByCategory'])->name('front.products.category');

// Static Pages
Route::get('/tentang', function () {
    return view('frontend.pages.about');
})->name('about');

Route::get('/kontak', function () {
    return view('frontend.pages.contact');
})->name('contact');

// =============== CART ROUTES ===============
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::put('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');
Route::get('/cart/count', [CartController::class, 'count'])->name('cart.count');
Route::get('/cart/total', [CartController::class, 'total'])->name('cart.total');

Route::post('/kontak', function () {
    request()->validate([
        'name' => 'required|string|min:3',
        'email' => 'required|email',
        'subject' => 'required|string',
        'message' => 'required|string|min:10'
    ]);

    return redirect()->route('contact')
        ->with('success', 'Terima kasih! Pesan Anda telah dikirim.');
})->name('contact.submit');

// =============== AUTH ROUTES ===============
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// =============== CUSTOMER/PROFIL ROUTES ===============
Route::middleware(['auth'])->group(function () {
    // Route profil (untuk pelanggan isi data sendiri)
    Route::get('/profil', [ProfilController::class, 'edit'])->name('profil.edit');
    Route::put('/profil', [ProfilController::class, 'update'])->name('profil.update');
    
    // Route customer lainnya
    Route::get('/profile', function() {
        return view('frontend.customer.profile');
    })->name('customer.profile');
    
    Route::get('/orders', function() {
        return view('frontend.customer.orders');
    })->name('customer.orders');
});

// =============== ADMIN ROUTES ===============
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    // DASHBOARD
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // RUTE UTAMA: /admin → Tampilkan Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('index');
    
    // CRUD untuk Admin/Kasir
    Route::resource('users', AdminController::class);
    
    // CRUD untuk Kategori
    Route::resource('kategori', KategoriController::class);
    
    // CRUD untuk Produk
    Route::resource('produk', ProdukController::class);
    
    // RUTE PELANGGAN
    Route::get('/pelanggan', [PelangganController::class, 'index'])->name('pelanggan.index');
    Route::get('/pelanggan/{pelanggan}', [PelangganController::class, 'show'])->name('pelanggan.show');
    Route::delete('/pelanggan/{pelanggan}', [PelangganController::class, 'destroy'])->name('pelanggan.destroy');
});

// =============== API ROUTES ===============
Route::get('/api/produk', function() {
    $products = \App\Models\Produk::with('kategori')->get();
    return response()->json($products);
});

Route::get('/api/kategori', function() {
    $categories = \App\Models\Kategori::withCount('produk')->get();
    return response()->json($categories);
});
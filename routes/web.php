<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\LaporanController;

/*
|--------------------------------------------------------------------------
| Web Routes - Pangsit Chili Oil
|--------------------------------------------------------------------------
|
| Route file untuk aplikasi e-commerce Pangsit Chili Oil
| Organized by: Public Routes → Auth → Customer → Admin
|
*/

// ============================================================================
// PUBLIC ROUTES (Accessible by everyone)
// ============================================================================

// --- Homepage ---
Route::get('/', [FrontendController::class, 'home'])->name('home');

// --- Product Routes ---
Route::prefix('produk')->name('front.')->group(function () {
    Route::get('/', [FrontendController::class, 'products'])->name('products');
    Route::get('/{id}', [FrontendController::class, 'productShow'])->name('product.show');
});

// --- Category Routes ---
Route::get('/kategori/{id}/produk', [FrontendController::class, 'productsByCategory'])
    ->name('front.products.category');

// --- Static Pages ---
Route::get('/tentang', [FrontendController::class, 'about'])->name('about');
Route::get('/kontak', [FrontendController::class, 'contact'])->name('contact');
Route::post('/kontak', [FrontendController::class, 'contactSubmit'])->name('contact.submit');

// ============================================================================
// SHOPPING CART ROUTES (Public - managed via session)
// ============================================================================

Route::prefix('cart')->name('cart.')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('index');
    Route::post('/add', [CartController::class, 'add'])->name('add');
    Route::put('/update/{id}', [CartController::class, 'update'])->name('update');
    Route::delete('/remove/{id}', [CartController::class, 'remove'])->name('remove');
    Route::post('/clear', [CartController::class, 'clear'])->name('clear');
    Route::post('/checkout', [CartController::class, 'checkout'])->name('checkout');
    
    // AJAX endpoints
    Route::get('/count', [CartController::class, 'count'])->name('count');
    Route::get('/total', [CartController::class, 'total'])->name('total');
});

// ============================================================================
// AUTHENTICATION ROUTES (Guest only)
// ============================================================================

Route::middleware('guest')->group(function () {
    // Login
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    
    // Register
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// Logout (Authenticated users only)
Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// ============================================================================
// CUSTOMER ROUTES (Authenticated users)
// ============================================================================

Route::middleware('auth')->group(function () {
    
    // --- Customer Profile ---
    Route::prefix('profile')->name('customer.')->group(function () {
        Route::get('/', [ProfilController::class, 'show'])->name('profile');
        Route::get('/edit', [ProfilController::class, 'edit'])->name('profile.edit');
        Route::put('/update', [ProfilController::class, 'update'])->name('profile.update');
    });
    
    // --- Customer Orders ---
    Route::get('/orders', [DashboardController::class, 'orders'])->name('customer.orders');
    Route::get('/orders/{id}', [DashboardController::class, 'orderDetail'])->name('customer.order.detail');
    Route::delete('/orders/{id}', [DashboardController::class, 'orderDestroy'])->name('customer.orders.destroy');
    
    // --- Legacy Profile Routes (Backward compatibility) ---
    Route::get('/profil', [ProfilController::class, 'edit'])->name('profil.edit');
    Route::put('/profil', [ProfilController::class, 'update'])->name('profil.update');
});

// ============================================================================
// ADMIN PANEL ROUTES (Authenticated users with admin/kasir role)
// ============================================================================

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // --- Dashboard ---
    Route::get('/', [DashboardController::class, 'index'])->name('index');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // --- Product Management (CRUD) ---
    Route::resource('produk', ProdukController::class);
    
    // --- Category Management (CRUD) ---
    Route::resource('kategori', KategoriController::class);
    
    // --- Customer Management ---
    Route::prefix('pelanggan')->name('pelanggan.')->group(function () {
        Route::get('/', [PelangganController::class, 'index'])->name('index');
        Route::get('/{pelanggan}', [PelangganController::class, 'show'])->name('show');
        Route::delete('/{pelanggan}', [PelangganController::class, 'destroy'])->name('destroy');
    });
    
    // --- User Management (Admin/Kasir CRUD) ---
    Route::resource('users', AdminController::class);

    // --- Laporan Penjualan ---
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::post('/laporan/generate-sample', [LaporanController::class, 'generateSampleData'])->name('laporan.sample');
    Route::patch('/laporan/{pesanan}/status', [LaporanController::class, 'updateStatus'])->name('laporan.updateStatus');
    Route::get('/laporan/{pesanan}', [LaporanController::class, 'show'])->name('laporan.show');
    
    // --- Notification System ---
    Route::get('/orders/check', [LaporanController::class, 'checkNewOrders'])->name('orders.check');
    Route::post('/orders/mark-notified', [LaporanController::class, 'markAsNotified'])->name('orders.markNotified');

    // --- Pengeluaran Operasional ---
    Route::resource('pengeluaran', \App\Http\Controllers\PengeluaranController::class);
});

// ============================================================================
// API ROUTES (JSON responses for AJAX/Mobile app)
// ============================================================================

Route::prefix('api')->name('api.')->group(function () {
    
    // Products API
    Route::get('/produk', function () {
        $products = \App\Models\Produk::with('kategori')->get();
        return response()->json([
            'success' => true,
            'data' => $products
        ]);
    })->name('products');
    
    // Categories API
    Route::get('/kategori', function () {
        $categories = \App\Models\Kategori::withCount('produk')->get();
        return response()->json([
            'success' => true,
            'data' => $categories
        ]);
    })->name('categories');

    // Customer Notification API
    Route::get('/notifications/check', [\App\Http\Controllers\CustomerNotificationController::class, 'checkUpdates'])->name('notifications.check');
    Route::post('/notifications/mark-read', [\App\Http\Controllers\CustomerNotificationController::class, 'markAsRead'])->name('notifications.markRead');
});

// ============================================================================
// FALLBACK ROUTE (404 handler)
// ============================================================================

Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});
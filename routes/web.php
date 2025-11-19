<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Models\Kategori;
use App\Models\Produk;
use App\Models\Pelanggan;

// Route test PostgreSQL
Route::get('/test-pgsql', function () {
    try {
        $results = [
            'database_driver' => DB::connection()->getPdo()->getAttribute(PDO::ATTR_DRIVER_NAME),
            'database_name' => DB::connection()->getDatabaseName(),
            'kategori_count' => Kategori::count(),
            'produk_count' => Produk::count(),
            'pelanggan_count' => Pelanggan::count(),
            'connection_status' => 'SUCCESS'
        ];
        
        return response()->json($results);
        
    } catch (Exception $e) {
        return response()->json([
            'error' => $e->getMessage(),
            'connection_status' => 'FAILED'
        ], 500);
    }
});
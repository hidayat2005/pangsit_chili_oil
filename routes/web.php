<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\KategoriController;

Route::get('/', function () {
    return view('welcome');
});

// Route untuk Produk
Route::resource('produk', ProdukController::class);

// Route untuk Kategori
Route::resource('kategori', KategoriController::class);
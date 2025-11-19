<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    // Tambahkan relasi jika diperlukan
    public function pesanan()
    {
        return $this->hasMany(Pesanan::class);
    }

    public function produk()
    {
        return $this->hasMany(Produk::class);
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemPesanan extends Model
{
    use HasFactory;

    protected $table = 'item_pesanan';

    protected $fillable = [
        'pesanan_id',
        'produk_id',
        'jumlah',
        'harga_saat_ini'
    ];

    public $timestamps = true;

    // Relasi ke pesanan
    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class, 'pesanan_id');
    }

    // Relasi ke produk
    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id');
    }
}
<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;

    protected $table = 'pesanan';
    
    protected $fillable = [
        'nomor_pesanan', 'pelanggan_id', 'total_harga', 'status_pesanan', 
        'catatan', 'whatsapp_terkirim', 'whatsapp_terkirim_pada'
    ];

    // ✅ CASTING UNTUK POSTGRESQL
    protected $casts = [
        'total_harga' => 'decimal:2',
        'whatsapp_terkirim' => 'boolean',
        'whatsapp_terkirim_pada' => 'datetime'
    ];

    // ... relasi tetap sama
}
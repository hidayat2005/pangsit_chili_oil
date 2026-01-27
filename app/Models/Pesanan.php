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
        'catatan', 'whatsapp_terkirim', 'whatsapp_terkirim_pada', 'admin_notified', 'customer_notified'
    ];

    //  CASTING UNTUK POSTGRESQL
    protected $casts = [
        'total_harga' => 'decimal:2',
        'whatsapp_terkirim' => 'boolean',
        'whatsapp_terkirim_pada' => 'datetime',
        'admin_notified' => 'boolean',
        'customer_notified' => 'boolean'
    ];

    // Relasi ke Pelanggan
    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'pelanggan_id');
    }

    // Relasi ke Item Pesanan
    public function items()
    {
        return $this->hasMany(ItemPesanan::class, 'pesanan_id');
    }
}
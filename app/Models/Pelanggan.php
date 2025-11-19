<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;

    // Tentukan nama tabel secara eksplisit
    protected $table = 'pelanggan';

    protected $fillable = [
        'nama_pelanggan',
        'nomor_telepon',
        'alamat',
        'email'
    ];

    // Nonaktifkan timestamps jika tidak perlu
    public $timestamps = true;

    // Relasi ke pesanan
    public function pesanan()
    {
        return $this->hasMany(Pesanan::class, 'pelanggan_id');
    }
}
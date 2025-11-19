<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Produk;

class ProdukSeeder extends Seeder
{
    public function run(): void
    {
        $produk = [
            [
                'nama_produk' => 'Pangsit Original 10pcs',
                'deskripsi' => 'Pangsit original dengan isian ayam dan udang pilihan, tekstur lembut',
                'harga' => 25000,
                'stok' => 50,
                'status' => 'tersedia',
                'kategori_id' => 1
            ],
            [
                'nama_produk' => 'Pangsit Pedas Level 1 - 10pcs',
                'deskripsi' => 'Pangsit dengan level pedas 1, cocok untuk pemula',
                'harga' => 27000,
                'stok' => 40,
                'status' => 'tersedia',
                'kategori_id' => 2
            ],
            [
                'nama_produk' => 'Pangsit Pedas Level 2 - 10pcs',
                'deskripsi' => 'Pangsit dengan level pedas 2, untuk yang suka tantangan',
                'harga' => 29000,
                'stok' => 35,
                'status' => 'tersedia',
                'kategori_id' => 2
            ],
            [
                'nama_produk' => 'Pangsit Pedas Level 3 - 10pcs',
                'deskripsi' => 'Pangsit dengan level pedas maksimal, hanya untuk yang berani!',
                'harga' => 32000,
                'stok' => 25,
                'status' => 'tersedia',
                'kategori_id' => 2
            ],
            [
                'nama_produk' => 'Chili Oil Original - 100ml',
                'deskripsi' => 'Saus chili oil original dengan aroma wangi dan rasa pas',
                'harga' => 15000,
                'stok' => 30,
                'status' => 'tersedia',
                'kategori_id' => 3
            ],
            [
                'nama_produk' => 'Chili Oil Extra Pedas - 100ml',
                'deskripsi' => 'Saus chili oil dengan tingkat kepedasan ekstra',
                'harga' => 18000,
                'stok' => 25,
                'status' => 'tersedia',
                'kategori_id' => 3
            ],
            [
                'nama_produk' => 'Paket Kombo Pangsit Original + Chili Oil',
                'deskripsi' => 'Paket hemat: 10pcs pangsit original + 100ml chili oil',
                'harga' => 35000,
                'stok' => 20,
                'status' => 'tersedia',
                'kategori_id' => 4
            ],
            [
                'nama_produk' => 'Paket Kombo Pangsit Pedas + Chili Oil Extra',
                'deskripsi' => 'Paket super pedas: 10pcs pangsit pedas + 100ml chili oil extra',
                'harga' => 45000,
                'stok' => 15,
                'status' => 'tersedia',
                'kategori_id' => 4
            ]
        ];

        foreach ($produk as $data) {
            Produk::create($data);
        }
    }
}
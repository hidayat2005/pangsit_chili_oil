<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pelanggan;

class PelangganSeeder extends Seeder
{
    public function run(): void
    {
        $pelanggan = [
            [
                'nama_pelanggan' => 'Budi Santoso',
                'nomor_telepon' => '081234567890',
                'alamat' => 'Jl. Merdeka No. 123, Jakarta Pusat',
                'email' => 'budi.santoso@email.com'
            ],
            [
                'nama_pelanggan' => 'Sari Indah Lestari',
                'nomor_telepon' => '081298765432',
                'alamat' => 'Jl. Sudirman No. 456, Bandung',
                'email' => 'sari.indah@email.com'
            ],
            [
                'nama_pelanggan' => 'Ahmad Wijaya',
                'nomor_telepon' => '081112223334',
                'alamat' => 'Jl. Gatot Subroto No. 789, Surabaya',
                'email' => 'ahmad.wijaya@email.com'
            ],
            [
                'nama_pelanggan' => 'Dewi Kartika',
                'nomor_telepon' => '081556677889',
                'alamat' => 'Jl. Pahlawan No. 321, Semarang',
                'email' => 'dewi.kartika@email.com'
            ]
        ];

        foreach ($pelanggan as $data) {
            Pelanggan::create($data);
        }
    }
}
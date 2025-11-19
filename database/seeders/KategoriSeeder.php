<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kategori;

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        $kategori = [
            [
                'nama_kategori' => 'Pangsit Original',
                'deskripsi' => 'Pangsit dengan rasa original dan lembut'
            ],
            [
                'nama_kategori' => 'Pangsit Pedas',
                'deskripsi' => 'Pangsit dengan berbagai level pedas'
            ],
            [
                'nama_kategori' => 'Chili Oil',
                'deskripsi' => 'Saus chili oil dengan cita rasa khas'
            ],
            [
                'nama_kategori' => 'Paket Kombo',
                'deskripsi' => 'Paket lengkap pangsit dan chili oil'
            ]
        ];

        foreach ($kategori as $data) {
            Kategori::create($data);
        }
    }
}
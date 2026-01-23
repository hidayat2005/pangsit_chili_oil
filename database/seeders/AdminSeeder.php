<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        Admin::create([
            'nama_lengkap' => 'Admin Pangsit Chili Oil',
            'username' => 'admin_pangsit',
            'email' => 'admin@pangsit.com',
            'password' => Hash::make('admin123'),
            'nomor_telepon' => '081234567890',
            'role' => 'admin',
            'status' => 'aktif'
        ]);

        Admin::create([
            'nama_lengkap' => 'Al Fikri Hidayat',
            'username' => 'fikri_admin',
            'email' => 'hidayat05fikri@gmail.com',
            'password' => Hash::make('fikri123'),
            'nomor_telepon' => '085279968474',
            'role' => 'admin',
            'status' => 'aktif'
        ]);

        Admin::create([
            'nama_lengkap' => 'Ahmad Wijaya',
            'username' => 'ahmad_kasir',
            'email' => 'ahmad.wijaya@email.com',
            'password' => Hash::make('kasir123'),
            'nomor_telepon' => '081112223334',
            'role' => 'kasir',
            'status' => 'aktif'
        ]);

        Admin::create([
            'nama_lengkap' => 'Siti Aminah',
            'username' => 'siti_kasir',
            'email' => 'siti@email.com',
            'password' => Hash::make('kasir123'),
            'nomor_telepon' => '081223344556',
            'role' => 'kasir',
            'status' => 'nonaktif'
        ]);
    }
}

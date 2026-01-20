<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Admin User
        User::create([
            'name' => 'Admin Pangsit Chili Oil',
            'email' => 'admin@pangsit.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);

        // Create Kasir User
        User::create([
            'name' => 'Kasir Pangsit Chili Oil',
            'email' => 'kasir@pangsit.com',
            'password' => Hash::make('kasir123'),
            'role' => 'kasir',
            'email_verified_at' => now(),
        ]);

        // Create Customer Test User
        User::create([
            'name' => 'Customer Test',
            'email' => 'customer@test.com',
            'password' => Hash::make('customer123'),
            'role' => 'customer',
            'email_verified_at' => now(),
        ]);
    }
}

<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'role' => 'string'
    ];

    // Relasi ke pelanggan
    public function pelanggan()
    {
        return $this->hasOne(Pelanggan::class);
    }

    // Cek apakah admin
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    // Cek apakah kasir
    public function isKasir()
    {
        return $this->role === 'kasir';
    }

    // Cek apakah customer
    public function isCustomer()
    {
        return $this->role === 'customer';
    }
}
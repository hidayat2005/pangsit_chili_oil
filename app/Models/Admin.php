<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    
    protected $table = 'admins';

    
    protected $fillable = [
        'nama_lengkap',
        'username',
        'password',
        'email',
        'nomor_telepon',
        'role',
        'status'
    ];

    //yang disembunyikan
    protected $hidden = [
        'password'
    ];
}

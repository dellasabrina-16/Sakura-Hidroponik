<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use Notifiable;

    // Kolom yang boleh diisi massal
    protected $fillable = [
        'email',
        'password',
        'foto',
        'role',
    ];

    // Kolom yang disembunyikan saat dikonversi ke array/JSON
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Jika mau, otomatis hash password saat di-set
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::make($password);
    }
}


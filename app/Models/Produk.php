<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $table = 'produks';

    protected $fillable = [
        'nama_produk',
        'foto_produk',
        'deskripsi_produk',
        'harga_kg',
    ];

    // Relasi ke stok
    public function stok()
    {
        return $this->hasOne(Stok::class, 'produk_id');
    }
}

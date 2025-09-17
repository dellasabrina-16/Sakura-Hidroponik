<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Stok;
use App\Models\DetailPesanan;

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

    // di Produk.php
    public function detailsPesanan()
    {
        return $this->hasMany(DetailPesanan::class, 'produk_id');
    }
}

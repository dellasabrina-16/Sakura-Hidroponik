<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Produk;
use App\Models\Pesanan;

class DetailPesanan extends Model
{
    protected $fillable = [
        'pesanan_id',
        'produk_id',
        'nama_produk',
        'harga_produk',
        'jumlah_kg',
        'harga'
    ];

    // Relasi ke produk
    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id');
    }

    // Relasi ke pesanan
    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class, 'pesanan_id');
    }
}

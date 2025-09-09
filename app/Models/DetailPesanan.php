<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailPesanan extends Model
{
    protected $fillable = ['pesanan_id', 'produk_id', 'jumlah_kg', 'harga'];

    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }
}
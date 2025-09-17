<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Produk;

class Stok extends Model
{
    protected $table = 'stoks';

    protected $fillable = [
        'produk_id',
        'stok_kg',
        'status',
    ];

    // Relasi ke produk
    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    protected $fillable = [
        'nama_pelanggan', 'tanggal_pesanan', 'jenis_pengambilan',
        'alamat', 'no_whatsapp', 'total_harga', 'status_pesanan', 'alasan_dibatalkan'
    ];

    public function details()
    {
        return $this->hasMany(DetailPesanan::class);
    }
}
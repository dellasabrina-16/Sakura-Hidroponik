<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('detail_pesanans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pesanan_id')
                ->constrained('pesanans')
                ->onDelete('cascade');

            // Produk boleh null kalau dihapus
            $table->foreignId('produk_id')
                ->nullable()
                ->constrained('produks')
                ->onDelete('set null');

            // Simpan salinan data produk saat transaksi
            $table->string('nama_produk');
            $table->integer('harga_produk');

            $table->integer('jumlah_kg');
            $table->integer('harga'); // total per item (jumlah_kg * harga_saat_pesan)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_pesanans');
    }
};

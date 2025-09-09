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
        Schema::create('pesanans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pelanggan');
            $table->date('tanggal_pesanan');
            $table->enum('jenis_pengambilan', ['diantar', 'ambil di kebun', 'ambil di rumah'])->default('diantar');
            $table->text('alamat');
            $table->string('no_whatsapp', 20);
            $table->integer('total_harga');
            $table->enum('status_pesanan', ['diproses', 'selesai', 'dibatalkan'])->default('diproses');
            $table->string('alasan_dibatalkan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesanans');
    }
};

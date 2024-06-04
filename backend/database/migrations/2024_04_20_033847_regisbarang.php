<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('regisbarang', function (Blueprint $table) {
            $table->id();
            $table->string('nama_barang');
            $table->enum('perusahaan', ['PT Makassar Metro Network', 'PT Makassar Airport Network'])->nullable();
            $table->string('merk')->nullable();
            $table->integer('stock')->nullable();
            $table->string('gambar')->nullable();
            $table->string('spesifikasi')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('regisbarang');
    }
};
    
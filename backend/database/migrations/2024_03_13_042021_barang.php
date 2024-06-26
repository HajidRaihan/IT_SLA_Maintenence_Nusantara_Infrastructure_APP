<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('barang', function (Blueprint $table) {
            $table->id();
            $table->string('nama_equipment');
            $table->enum('perusahaan', ['PT Makassar Metro Network', 'PT Makassar Airport Network'])->nullable();
            $table->string('merk')->nullable();
            $table->integer('stock')->nullable();
            $table->integer('addata')->nullable();
            $table->string('gambar')->nullable();
            $table->string('adddata_string')->nullable();
            $table->string('catatan')->nullable();
            $table->timestamps();
        });  
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang');
    }
};
 
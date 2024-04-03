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
            $table->enum('perusahaan', ['PT Makassar Metro Network', 'PT Jalan Tol Seksi Empat'])->nullable();
            $table->string('unit')->nullable();
            $table->string('merk')->nullable();
            $table->integer('stock')->nullable();
            $table->string('gambar');
            $table->integer('adddata')->nullable()->default(0);
            $table->integer('mindata')->nullable();
            $table->enum('adddata_string', ['masuk', 'keluar'])->nullable();
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
 
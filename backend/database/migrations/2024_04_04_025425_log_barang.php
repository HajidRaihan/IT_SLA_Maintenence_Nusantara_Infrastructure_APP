<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('log_barang', function (Blueprint $table) {
            $table->id();
            $table->string('id_barang');
            $table->string('nama_equipment');
            $table->enum('perusahaan', ['PT Makassar Metro Network', 'PT Makassar Airport Network'])->nullable();
            $table->string('merk')->nullable();
            $table->integer('addata')->nullable();
            $table->string('adddata_string')->nullable();
            $table->string('spesifikasi')->nullable();
            $table->string('stock')->nullable();
            $table->timestamps();
        });  
    }

    public function down(): void
    {
        Schema::dropIfExists('log_barang');
        
    }
};

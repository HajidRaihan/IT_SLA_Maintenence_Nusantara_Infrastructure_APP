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
            $table->dateTime('tanggal');
            $table->string('nama_equipment');
            $table->enum('perusahaan', ['PT Makassar Metro Network', 'PT Jalan Tol Seksi Empat'])->nullable();
            $table->string('unit')->nullable();
            $table->string('merk')->nullable();
            $table->integer('stock')->nullable();
            $table->string('activity')->nullable();
            $table->timestamps();
        });  
    }

    public function down(): void
    {
        Schema::dropIfExists('log_barang');
        
    }
};

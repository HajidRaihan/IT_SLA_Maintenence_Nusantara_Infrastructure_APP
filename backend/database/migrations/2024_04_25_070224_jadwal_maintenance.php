<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('jadwal_maintenance', function (Blueprint $table) {
            $table->id();
            $table->enum('jenis_perusahaan', ['tol', 'non tol']);
            $table->string('uraian_kegiatan');
            $table->integer('tahun');
            $table->string('lokasi');
            $table->enum('frekuensi', ['1x pertahun', '2x pertahun']);
            $table->json('waktu');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        
            Schema::dropIfExists('jadwal_maintenance');
        
    }
};

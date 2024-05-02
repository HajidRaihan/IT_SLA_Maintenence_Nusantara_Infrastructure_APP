<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jenis_hardware', function (Blueprint $table) {
            $table->id();
            $table->string('nama_hardware');
            $table->unsignedInteger('jumlah_kerusakan')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jenis_hardware');
    }
};

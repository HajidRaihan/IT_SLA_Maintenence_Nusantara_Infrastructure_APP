<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('employee', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->enum('jabatan', ['teknisi', 'kspt']);
            $table->string('ttd');
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('employee');
        
    }
};

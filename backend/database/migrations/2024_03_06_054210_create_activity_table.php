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
        Schema::create('activity', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->enum('company', ['jtse', 'mmn']);
            $table->date('tanggal');
            $table->string('jenis_hardware');
            $table->string('standart_aplikasi');
            $table->string('uraian_hardware');
            $table->string('uraian_aplikasi');
            $table->string('aplikasi_it_tol');
            $table->string('uraian_it_tol');
            $table->string('catatan');
            $table->string('shift');
            $table->unsignedBigInteger('lokasi_id');
            $table->unsignedBigInteger('kategori_id');
            $table->string('kondisi_akhir');
            $table->integer('biaya');
            $table->string('fotos')->default('default_value')->nullable();
            $table->enum('status', ['prosses', 'done']);
            $table->timestamp('ended_at');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade');
            $table->foreign('lokasi_id')->references('id')->on('lokasi')->onUpdate('cascade');
            $table->foreign('kategori_id')->references('id')->on('kategori')->onUpdate('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     * user_id integer [primary key]
     */
    public function down(): void
    {
        Schema::dropIfExists('activity');
    }
};

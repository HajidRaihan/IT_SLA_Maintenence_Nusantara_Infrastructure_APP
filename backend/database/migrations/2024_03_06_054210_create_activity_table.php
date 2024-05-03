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
            $table->enum('company', ['man', 'mmn']);
            // $table->date('tanggal');
            $table->string('jenis_hardware')->nullable();
            $table->string('standart_aplikasi')->nullable();
            $table->string('uraian_hardware')->nullable();
            $table->string('uraian_aplikasi')->nullable();
            $table->string('aplikasi_it_tol')->nullable();
            $table->string('uraian_it_tol')->nullable();
            $table->string('catatan')->nullable();
            $table->string('shift');
            $table->unsignedBigInteger('lokasi_id');
            $table->unsignedBigInteger('kategori_id');
            $table->string('kondisi_akhir')->nullable();
            $table->integer('biaya')->nullable();
            $table->string('foto_awal');
            $table->string('foto_akhir')->nullable()->default('png');
            $table->enum('kategori_activity', ['toll', 'nontoll']);
            $table->enum('status', ['process', 'pending', 'done'])->default('process');
            $table->string('waktu_pengerjaan')->nullable();
            $table->timestamp('created_at')->useCurrent();
            // $table->timestamp('process_at')->nullable();
            $table->timestamp('updated_at')->useCurrent();
            $table->timestamp('ended_at')->nullable();

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

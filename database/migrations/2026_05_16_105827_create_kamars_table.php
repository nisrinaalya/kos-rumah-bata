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
        Schema::create('kamars', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_kamar', 10);
            $table->string('tower', 50);
            $table->enum('tipe_kamar', ['ac', 'non-ac']);
            $table->bigInteger('harga');
            $table->string('dalam_hitungan', 50)->default('tahun');
            $table->string('luas', 30);
            $table->text('fasilitas');
            $table->text('deskripsi')->nullable();
            $table->enum('status', ['tersedia', 'penuh'])->default('tersedia');

            // Pembaruan Kolom Foto
            $table->string('foto_utama')->nullable();
            $table->string('foto_tambahan_1')->nullable();
            $table->string('foto_tambahan_2')->nullable();
            $table->string('foto_tambahan_3')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kamars');
    }
};

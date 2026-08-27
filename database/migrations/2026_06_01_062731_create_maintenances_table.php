<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('maintenances', function (Blueprint $table) {
            $table->id();
            // Foreign key ke tabel kamars
            $table->foreignId('kamar_id')->constrained('kamars')->onDelete('cascade');

            $table->string('nama_perbaikan');
            $table->enum('status', ['menunggu', 'proses', 'selesai'])->default('menunggu');
            $table->bigInteger('biaya')->nullable(); // Disimpan sebagai angka (integer) agar mudah dihitung
            $table->date('tanggal_laporan')->nullable();
            $table->date('estimasi_selesai')->nullable();
            $table->text('deskripsi')->nullable();
            $table->string('foto_maintenance')->nullable(); // Menyimpan path/nama file foto
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('maintenances');
    }
};

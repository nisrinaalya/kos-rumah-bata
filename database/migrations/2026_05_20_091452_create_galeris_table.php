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
        Schema::create('galeris', function (Blueprint $table) {
            $table->id();
            $table->string('image'); // Menyimpan path/nama file foto
            $table->enum('status', ['aktif', 'nonaktif'])->default('aktif'); // Status tampilan
            $table->integer('sort_order')->default(1); // Urutan foto
            $table->string('title')->nullable();        // Tambahkan ini untuk judul foto
            $table->text('description')->nullable();    // Tambahkan ini untuk deskripsi foto
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('galeris');
    }
};
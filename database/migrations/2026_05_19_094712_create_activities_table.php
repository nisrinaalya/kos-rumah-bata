<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('image')->nullable();
            $table->string('category')->default('Aktivitas'); // Tambah kolom Kategori
            $table->date('date'); // Tambah kolom Tanggal Rilis
            $table->boolean('is_pinned')->default(false); // Tambah kolom Sematkan (0 atau 1)
            $table->enum('status', ['aktif', 'nonaktif'])->default('aktif'); // Digunakan di badge list
            $table->integer('sort_order')->default(1); 
            $table->string('link_url')->nullable();
            $table->string('link_label')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('activities');
    }
};
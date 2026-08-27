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
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id();

            $table->foreignId('pengajuan_sewa_id')->nullable()->constrained('pengajuan_sewas')->onDelete('set null');

            $table->integer('nominal');
            $table->enum('tipe_pembayaran', ['dp', 'pelunasan', 'full'])->nullable();
            $table->date('tanggal_bayar');
            $table->enum('jenis', ['pemasukan', 'pengeluaran']);
            $table->string('nama');
            $table->text('deskripsi')->nullable();

            $table->string('bukti_transfer')->nullable();
            $table->enum('status', ['pending', 'disetujui', 'ditolak'])->default('pending');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayarans');
    }
};

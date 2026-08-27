<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Maintenance extends Model
{
    use HasFactory;

    protected $fillable = [
        'kamar_id',
        'nama_perbaikan',
        'status',
        'biaya',
        'tanggal_laporan',
        'estimasi_selesai',
        'deskripsi',
        'foto_maintenance',
    ];

    /**
     * Relasi ke model Kamar
     */
    public function kamar(): BelongsTo
    {
        return $this->belongsTo(Kamar::class, 'kamar_id');
    }
}

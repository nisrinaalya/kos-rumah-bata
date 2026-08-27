<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kamar extends Model
{
    use HasFactory;

    protected $table = 'kamars';

    protected $fillable = [
        'nomor_kamar',
        'tower',
        'tipe_kamar',
        'harga',
        'dalam_hitungan',
        'luas',
        'fasilitas',
        'deskripsi',
        'status',
        'foto_utama',
        'foto_tambahan_1',
        'foto_tambahan_2',
        'foto_tambahan_3'
    ];

    protected $casts = [
        'fasilitas' => 'array',
        'harga' => 'integer'
    ];
}

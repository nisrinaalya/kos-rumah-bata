<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Galeri extends Model
{
    use HasFactory;

    // Menentukan nama tabel (opsional, karena otomatis jamak dari galeri jika sesuai konvensi)
    protected $table = 'galeris';

    // Mass Assignment perlindungan kolom database
    protected $fillable = [
        'title',
        'description',
        'image',
        'status',
        'sort_order',
    ];
}
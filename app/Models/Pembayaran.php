<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    protected $table = 'pembayarans';

    protected $fillable = [
        'pengajuan_sewa_id',
        'nominal',
        'tipe_pembayaran',
        'tanggal_bayar',
        'jenis',
        'nama',
        'deskripsi',
        'bukti_transfer',
        'status',
    ];

    /**
     * Relasi ke PengajuanSewa (Setiap baris pembayaran terhubung ke sebuah pengajuan sewa)
     */
    public function pengajuanSewa()
    {
        return $this->belongsTo(PengajuanSewa::class, 'pengajuan_sewa_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengajuanSewa extends Model
{
    use HasFactory;

    protected $table = 'pengajuan_sewas';

    protected $fillable = [
        'order_id',
        'user_id',
        'kamar_id',
        'tanggal_mulai',
        'durasi_sewa',
        'catatan',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function kamar()
    {
        return $this->belongsTo(Kamar::class, 'kamar_id');
    }

    public function pembayarans()
    {
        return $this->hasMany(Pembayaran::class, 'pengajuan_sewa_id');
    }
}

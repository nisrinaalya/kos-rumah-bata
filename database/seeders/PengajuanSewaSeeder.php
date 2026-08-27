<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\PengajuanSewa;
use Carbon\Carbon;

class PengajuanSewaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Mengambil user berdasarkan email yang telah dibuat di UserSeeder
        $satu = User::where('email', 'satu@gmail.com')->first();
        $dua = User::where('email', 'dua@gmail.com')->first();
        $tiga = User::where('email', 'tiga@gmail.com')->first();
        $empat = User::where('email', 'empat@gmail.com')->first();

        // 2. Pengajuan Izza (Status: pending)
        if ($satu) {
            PengajuanSewa::create([
                'id'            => 1,
                'order_id'      => 'KRB-GJL-2002',
                'user_id'       => $satu->id,
                'kamar_id'      => 1,
                'tanggal_mulai' => Carbon::now()->addDays(7)->format('Y-m-d'),
                'durasi_sewa'   => 12,
                'status'        => 'pending',
            ]);
        }

        // 3. Pengajuan Faza (Status: pending)
        if ($dua) {
            PengajuanSewa::create([
                'id'            => 2,
                'order_id'      => 'KRB-GNP-3003',
                'user_id'       => $dua->id,
                'kamar_id'      => 4,
                'tanggal_mulai' => Carbon::now()->addDays(10)->format('Y-m-d'),
                'durasi_sewa'   => 12,
                'status'        => 'pending',
            ]);
        }

        // 4. Pengajuan Fadhil (Status: ditolak)
        if ($tiga) {
            PengajuanSewa::create([
                'id'            => 3,
                'order_id'      => 'KRB-GJL-4004',
                'user_id'       => $tiga->id,
                'kamar_id'      => 3,
                'tanggal_mulai' => Carbon::now()->addDays(3)->format('Y-m-d'),
                'durasi_sewa'   => 6,
                'status'        => 'ditolak',
            ]);
        }

        // 5. Pengajuan Putra (Status: disetujui)
        if ($empat) {
            PengajuanSewa::create([
                'id'            => 4,
                'order_id'      => 'KRB-GNP-5005',
                'user_id'       => $empat->id,
                'kamar_id'      => 20,
                'tanggal_mulai' => Carbon::now()->addDays(14)->format('Y-m-d'),
                'durasi_sewa'   => 12,
                'status'        => 'disetujui',
            ]);
        }
    }
}

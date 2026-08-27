<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pembayaran;
use App\Models\PengajuanSewa;
use Carbon\Carbon;

class PembayaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $sewa1 = PengajuanSewa::find(1);
        if ($sewa1) {
            Pembayaran::create([
                'pengajuan_sewa_id' => $sewa1->id,
                'nominal'           => 14500000,
                'tipe_pembayaran'   => 'full',
                'tanggal_bayar'     => Carbon::now()->subDays(2)->format('Y-m-d'),
                'jenis'             => 'pemasukan',
                'nama'              => 'Pembayaran Sewa ' . $sewa1->kamar->nama . ' (Full)',
                'deskripsi'         => 'Pembayaran lunas tahunan dari customer Badzlan.',
                'bukti_transfer'    => '/images/bukti_transfer/1780131932-bukti.jpg',
                'status'            => 'disetujui',
            ]);
        }

        $sewa2 = PengajuanSewa::find(2);
        if ($sewa2) {
            Pembayaran::create([
                'pengajuan_sewa_id' => $sewa2->id,
                'nominal'           => 6250000,
                'tipe_pembayaran'   => 'dp',
                'tanggal_bayar'     => Carbon::now()->subDays(5)->format('Y-m-d'),
                'jenis'             => 'pemasukan',
                'nama'              => 'Pembayaran Sewa ' . $sewa2->kamar->nama . ' (DP)',
                'deskripsi'         => 'Pembayaran DP awal 50% dari customer Izza.',
                'bukti_transfer'    => '/images/bukti_transfer/sample-dp.png',
                'status'            => 'disetujui',
            ]);

            Pembayaran::create([
                'pengajuan_sewa_id' => $sewa2->id,
                'nominal'           => 6250000,
                'tipe_pembayaran'   => 'pelunasan',
                'tanggal_bayar'     => Carbon::now()->format('Y-m-d'),
                'jenis'             => 'pemasukan',
                'nama'              => 'Pembayaran Sewa ' . $sewa2->kamar->nama . ' (Pelunasan)',
                'deskripsi'         => 'Pelunasan sisa tagihan kos dari customer Izza.',
                'bukti_transfer'    => '/images/bukti_transfer/sample-pelunasan.png',
                'status'            => 'pending',
            ]);
        }

        $sewa3 = PengajuanSewa::find(3);
        if ($sewa3) {
            Pembayaran::create([
                'pengajuan_sewa_id' => $sewa3->id,
                'nominal'           => 7250000,
                'tipe_pembayaran'   => 'dp',
                'tanggal_bayar'     => Carbon::now()->format('Y-m-d'),
                'jenis'             => 'pemasukan',
                'nama'              => 'Pembayaran Sewa ' . $sewa3->kamar->nama . ' (DP)',
                'deskripsi'         => 'Bukti transfer DP dari customer Faza baru masuk.',
                'bukti_transfer'    => '/images/bukti_transfer/sample-bukti3.png',
                'status'            => 'pending',
            ]);
        }

        $sewa4 = PengajuanSewa::find(4);
        if ($sewa4) {
            Pembayaran::create([
                'pengajuan_sewa_id' => $sewa4->id,
                'nominal'           => 12500000,
                'tipe_pembayaran'   => 'full',
                'tanggal_bayar'     => Carbon::now()->subDays(4)->format('Y-m-d'),
                'jenis'             => 'pemasukan',
                'nama'              => 'Pembayaran Sewa ' . $sewa4->kamar->nama . ' (Full)',
                'deskripsi'         => 'Ditolak karena nominal transfer di struk berbeda dengan harga asli.',
                'bukti_transfer'    => '/images/bukti_transfer/sample-reject.png',
                'status'            => 'ditolak',
            ]);
        }

        Pembayaran::create([
            'pengajuan_sewa_id' => null,
            'nominal'           => 450000,
            'tipe_pembayaran'   => null,
            'tanggal_bayar'     => Carbon::now()->subDays(3)->format('Y-m-d'),
            'jenis'             => 'pengeluaran',
            'nama'              => 'Pembelian Keran untuk Kamar 40',
            'deskripsi'         => 'Pengeluaran perbaikan keran untuk maintenance kamar 40.',
            'bukti_transfer'    => null,
            'status'            => 'disetujui',
        ]);
    }
}

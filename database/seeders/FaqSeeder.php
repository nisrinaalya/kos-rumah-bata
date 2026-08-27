<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faqs = [
            [
                'question' => 'Apakah Kos Rumah Bata menerima mahasiswa?',
                'answer' => 'Ya, Kos Rumah Bata menerima mahasiswa dan pekerja dengan data yang sudah diverifikasi oleh admin.',
                'status' => 'aktif',
                'sort_order' => 1,
            ],
            [
                'question' => 'Bagaimana cara mengajukan sewa kamar?',
                'answer' => 'Calon penghuni dapat memilih kamar di website, mengisi formulir pengajuan, lalu menunggu verifikasi dari admin.',
                'status' => 'aktif',
                'sort_order' => 2,
            ],
            [
                'question' => 'Apakah pembayaran bisa dilakukan dengan DP?',
                'answer' => 'Bisa. Calon penghuni dapat memilih pembayaran DP sesuai ketentuan, kemudian melunasi pembayaran sebelum batas waktu yang ditentukan.',
                'status' => 'aktif',
                'sort_order' => 3,
            ],
            [
                'question' => 'Apakah tersedia kamar AC dan Non AC?',
                'answer' => 'Ya, tersedia kamar AC dan Non AC. Kamar genap menggunakan tipe AC, sedangkan kamar ganjil menggunakan tipe Non AC.',
                'status' => 'aktif',
                'sort_order' => 4,
            ],
        ];

        foreach ($faqs as $faq) {
            Faq::create($faq);
        }
    }
}
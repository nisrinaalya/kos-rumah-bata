<?php

namespace Database\Seeders;

use App\Models\Activity;
use Illuminate\Database\Seeder;

class ActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $activities = [
            [
                'title' => 'Promo Khusus Penghuni Baru Bulan Ini',
                'description' => 'Diskon 10% untuk pembayaran 3 bulan di muka. Berlaku sampai akhir bulan, klik tautan di bawah ini atau DM admin untuk klaim sekarang.',
                'image' => null,
                'link_url' => 'https://wa.me/628194001701',
                'link_label' => 'Klaim Promo via WhatsApp',
                'category' => 'Promo',
                'date' => now()->format('Y-m-d'),
                'is_pinned' => true,
                'status' => 'aktif',
                'sort_order' => 1,
            ],
            [
                'title' => 'Kamar A2 Standard Non AC Sudah Tersedia',
                'description' => 'Cocok buat kamu yang cari kos nyaman dengan harga ramah kantong. Segera jadwalkan survei dan booking lebih awal sebelum diambil orang.',
                'image' => null,
                'link_url' => 'http://kos-rumah-bata.test/kamar',
                'link_label' => 'Lihat Detail Kamar A2',
                'category' => 'Info Kamar',
                'date' => now()->subDays(1)->format('Y-m-d'),
                'is_pinned' => false,
                'status' => 'aktif',
                'sort_order' => 2,
            ],
            [
                'title' => 'Makan Malam Bersama Penghuni Kos',
                'description' => 'Keseruan agenda makan malam bersama penghuni semalam. Menu nasi liwet dan ayam bakar ludes dalam waktu singkat. Terima kasih untuk semua yang ikut meramaikan.',
                'image' => null,
                'link_url' => null,
                'link_label' => null,
                'category' => 'Aktivitas',
                'date' => now()->subDays(2)->format('Y-m-d'),
                'is_pinned' => false,
                'status' => 'aktif',
                'sort_order' => 3,
            ],
            [
                'title' => 'Jangan Lupa Follow Akun Instagram Resmi Kami',
                'description' => 'Dapatkan informasi terupdate mengenai event internal, info ketersediaan tipe kamar kosong, info promo, dan cerita keseharian menarik di dalam lingkup kos.',
                'image' => null,
                'link_url' => 'https://instagram.com',
                'link_label' => 'Follow Instagram',
                'category' => 'Social',
                'date' => now()->subDays(5)->format('Y-m-d'),
                'is_pinned' => false,
                'status' => 'aktif',
                'sort_order' => 4,
            ]
        ];

        foreach ($activities as $activity) {
            Activity::create($activity);
        }
    }
}
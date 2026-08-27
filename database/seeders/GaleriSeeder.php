<?php

namespace Database\Seeders;

use App\Models\Galeri;
use Illuminate\Database\Seeder;

class GaleriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Data bawaan diperbarui berdasarkan JSON terbaru Anda
        $dataGaleri = [
            [
                'image' => '/images/galeri/galeri-1.jpeg',
                'title' => 'Kumpul Pertemuan',
                'description' => 'Momen berkumpul dan berbincang bersama untuk mempererat kebersamaan.',
                'status' => 'aktif',
                'sort_order' => 1,
            ],
            [
                'image' => '/images/galeri/galeri-2.jpeg',
                'title' => 'Halal Bihalal',
                'description' => 'Acara silaturahmi yang penuh kehangatan setelah Hari Raya Idulfitri.',
                'status' => 'aktif',
                'sort_order' => 2,
            ],
            [
                'image' => '/images/galeri/galeri-3.jpeg',
                'title' => 'Kumpul Pertemuan 2',
                'description' => 'Momen berkumpul dan berbincang bersama untuk mempererat kebersamaan.',
                'status' => 'aktif',
                'sort_order' => 3,
            ],
            [
                'image' => '/images/galeri/galeri-4.jpeg',
                'title' => 'Buka Bersama 2026',
                'description' => 'Kegiatan buka puasa bersama tahun 2026 yang penuh kehangatan, kebersamaan, dan kebahagiaan.',
                'status' => 'aktif',
                'sort_order' => 4,
            ],
            [
                'image' => '/images/galeri/galeri-5.jpeg',
                'title' => 'Kumpul Pertemuan 3',
                'description' => 'Momen berkumpul dan berbincang bersama untuk mempererat kebersamaan.',
                'status' => 'aktif',
                'sort_order' => 5,
            ],
            [
                'image' => '/images/galeri/galeri-.6jpeg',
                'title' => 'Foto Angkatan 61',
                'description' => 'Potret kebersamaan seluruh anggota Angkatan 61 yang menjadi kenangan dan simbol kekompakan angkatan.',
                'status' => 'aktif',
                'sort_order' => 6,
            ],
        ];

        // Kosongkan data galeri lama terlebih dahulu agar tidak duplikat saat seeding ulang
        Galeri::truncate();

        foreach ($dataGaleri as $galeri) {
            Galeri::create($galeri);
        }
    }
}

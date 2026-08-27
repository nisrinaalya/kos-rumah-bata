<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kamar;

class KamarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $deskripsi = "• kamar luas 3x3m\n" .
                     "• ⁠kamar mandi di dalam luas 1,5x1,5m\n" .
                     "• ⁠tempat tidur 2 in 1 bisa jadi sofa\n" .
                     "• ⁠lemari baju gantung\n" .
                     "• Free wifi\n" .
                     "• Dapur umum luas ada kulkas dan frezer dan ruang makan\n" .
                     "• Area belajar kelompok khusus wanita\n" .
                     "• Area cuci baju ada mesin cuci dan area jemur\n" .
                     "• View gunung\n" .
                     "• Taman belakang\n" .
                     "• ⁠Ventilasi cahaya dan udara sangat baik\n" .
                     "• Listrik token masing masing\n" .
                     "• Tidak ada iuran air\n" .
                     "• Keamanan 24jam yg jaga\n" .
                     "• Tersedia Paket Catering harian";

        for ($i = 1; $i <= 40; $i++) {
            $isGenap = ($i % 2 === 0);

            Kamar::create([
                'nomor_kamar'     => (string)$i,
                'tower'           => $isGenap ? 'genap' : 'ganjil',
                'tipe_kamar'      => $isGenap ? 'ac' : 'non-ac',
                'harga'           => $isGenap ? 14500000 : 12500000,
                'dalam_hitungan'  => 'tahun',
                'luas'            => '3 × 3 meter',
                'fasilitas'       => $isGenap
                                     ? ['Kasur', 'Lemari', 'KM Dalam', 'AC']
                                     : ['Kasur', 'Lemari', 'KM Dalam'],
                'deskripsi'       => $deskripsi,
                'status'          => fake()->randomElement(['tersedia', 'penuh']),
                'foto_utama'      => $isGenap ? '/images/kamar/genap-2.jpeg' : '/images/kamar/ganjil-3.jpeg',
                'foto_tambahan_1' => $isGenap ? '/images/kamar/genap-1.jpeg' : '/images/kamar/ganjil-2.jpeg',
                'foto_tambahan_2' => $isGenap ? '/images/kamar/genap-3.jpeg' : '/images/kamar/ganjil-1.jpeg',
                'foto_tambahan_3' => $isGenap ? '/images/kamar/genap-4.jpeg' : '/images/kamar/ganjil-4.jpeg',
            ]);
        }
    }
}

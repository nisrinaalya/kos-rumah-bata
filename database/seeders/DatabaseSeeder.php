<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            KamarSeeder::class,
            PengajuanSewaSeeder::class,
            PembayaranSeeder::class,
            FaqSeeder::class,
            ActivitySeeder::class,
            // GaleriSeeder::class,
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Akun Admin Utama
        User::create([
            'nama'            => 'Admin Kos Rumah Bata',
            'email'           => 'admin@gmail.com',
            'role'            => 'admin',
            'password'        => Hash::make('admin123'),
            'no_hp'           => '081234567890',
            'alamat'          => 'Kantor Pengelola Kos Rumah Bata',
        ]);

        // 4. Dummy Customer 1
        User::create([
            'nama'            => 'Dummy 1',
            'email'           => 'satu@gmail.com',
            'role'            => 'customer',
            'password'        => Hash::make('12345678'),
            'no_hp'           => '085711112222',
            'alamat'          => 'Depok, Jawa Barat',
        ]);

        // 5. Dummy Customer 2
        User::create([
            'nama'            => 'Dummy 2',
            'email'           => 'dua@gmail.com',
            'role'            => 'customer',
            'password'        => Hash::make('12345678'),
            'no_hp'           => '085733334444',
            'alamat'          => 'Bandung, Jawa Barat',
        ]);

        // 6. Dummy Customer 3
        User::create([
            'nama'            => 'Dummy 3',
            'email'           => 'tiga@gmail.com',
            'role'            => 'customer',
            'password'        => Hash::make('12345678'),
            'no_hp'           => '085755556666',
            'alamat'          => 'Bekasi, Jawa Barat',
        ]);

        // 7. Dummy Customer 4
        User::create([
            'nama'            => 'Dummy 4',
            'email'           => 'empat@gmail.com',
            'role'            => 'customer',
            'password'        => Hash::make('12345678'),
            'no_hp'           => '085777778888',
            'alamat'          => 'Tangerang, Banten',
        ]);
    }
}

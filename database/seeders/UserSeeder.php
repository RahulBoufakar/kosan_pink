<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\kamar;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Tambahkan user dengan role admin
        User::create([
            'name' => 'admin',
            'email' => 'admin@test.com',
            'password' => bcrypt('admin123'),
            'role' => 'admin',
            'no_hp' => '08123456789',
            'kamar_id' => null, // Admin tidak memiliki kamar
        ]);

        // Hitung jumlah kamar yang tersedia
        $count_kamar_tersedia = kamar::where('status', 'tersedia')->count();

        // Jika tidak ada kamar yang tersedia, hentikan seeding
        if ($count_kamar_tersedia == 0) {
            $this->command->error('Tidak ada kamar yang tersedia untuk seeding user.');
            return;
        }

        // Buat user sesuai dengan jumlah kamar yang tersedia
        for ($i = 1; $i <= $count_kamar_tersedia; $i++) {
            User::create([
                'name' => 'User ' . $i,
                'email' => 'user' . $i . '@example.com',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
                'role' => 'user',
                'no_hp' => '08123456789' . $i,
                'kamar_id' => kamar::where('status', 'tersedia')->first()->id,
            ]);

            // Update status kamar menjadi 'tidak tersedia'
            kamar::where('status', 'tersedia')->first()->update(['status' => 'penuh']);

        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\kamar;
use App\Models\User;
use App\Models\laporan;
use Illuminate\Support\Arr;

class KamarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Buat 20 kamar dengan nomor 1 sampai 20 dan status 'tersedia'
        for($i=1; $i<=20; $i++){
            kamar::create([
                'nomor_kamar' => $i,
                'status' => 'tersedia',
            ]);
        }
    }
}

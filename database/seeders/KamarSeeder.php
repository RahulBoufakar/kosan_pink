<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\kamar;
use Illuminate\Support\Arr;

class KamarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for($i=1; $i<=20; $i++){
            kamar::create([
                'nomor_kamar' => $i,
                'status' => Arr::random(['tersedia', 'penuh', 'diperbaiki']),
            ]);
        }
    }
}

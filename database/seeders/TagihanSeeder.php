<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tagihan;

class TagihanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for($i = 1; $i <= 10; $i++) {
            Tagihan::create([
                'user_id' => 2,
                'tanggal_tagihan' => now()->format('Y-m-d'),
                'jumlah_tagihan' => 450000,
                'status_pembayaran' => 'belum_bayar'
            ]);
        }

    }
}

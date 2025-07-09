<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Laporan;

class LaporanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create 10 sample reports
        for ($i = 1; $i <= 10; $i++) {
            Laporan::create([
                'user_id' => 2, // Assuming user with ID 2 exists
                'media' => 'media_' . $i . '.jpg',
                'tanggal_laporan' => now()->subDays($i),
                'deskripsi' => 'Isi laporan ke-' . $i,
                'status_laporan' => $i % 2 === 0 ? 'proses' : 'selesai',
            ]);
        }
    }
}

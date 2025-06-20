<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\kamar;
use App\Models\User;
use App\Models\laporan;
use Illuminate\Support\Facades\DB;
// use App\Models\Tagihan;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Truncate tables to start fresh
        // Disable foreign key checks to avoid constraint violations during truncation
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        laporan::truncate();
        User::truncate();
        Kamar::truncate();
        // Tagihan::truncate();
        //Enable foreign key checks again
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');


        // Call other seeders here
        $this->call([
            KamarSeeder::class,
            UserSeeder::class,
            // LaporanSeeder::class,
            // TagihanSeeder::class,
        ]);
    }
}

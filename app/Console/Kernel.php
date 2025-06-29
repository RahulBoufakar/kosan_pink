<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // Menjadwalkan perintah untuk menambahkan tagihan bulanan setiap bulan pada tanggal 17 pukul 05:00
        // $schedule->command('tambah-tagihan')->monthlyOn(17, '05:00')->timezone('Asia/Jakarta');
        $schedule->command('tambah-tagihan')->everyMinute()->timezone('Asia/Jakarta');
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}

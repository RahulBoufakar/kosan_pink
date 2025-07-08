<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Tagihan;
use Carbon\Carbon;

class TambahTagihanBulanan extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tambah-tagihan {--amount=450000 : Jumlah tagihan yang akan ditambahkan}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Menambah tagihan bulanan untuk semua user';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $amount = $this->option('amount');

        // Validasi input
        if (!is_numeric($amount) || $amount <= 0) {
            $this->error('Jumlah tagihan harus berupa angka positif.');
            return;
        }

        // buat progres bar
        $this->output->progressStart(User::where('role', 'user')->count());
        foreach (User::all()->where('role', 'user') as $user) {
            Tagihan::create([
                'user_id' => $user->id,
                'tanggal_tagihan' => now()->format('Y-m-d'),
                'jumlah_tagihan' => $amount,
                'status_pembayaran' => 'belum_bayar',
            ]);
            $this->output->progressAdvance();
        }
        // update progres bar
        $this->output->progressFinish();

        // Tampilkan pesan sukses
        $this->info('Tagihan bulanan berhasil ditambahkan untuk semua user.');
        $this->info("Jumlah tagihan: Rp " . number_format($amount, 0, ',', '.'));
        $this->info("Tanggal tagihan: " . now()->format('Y-m-d'));
        $this->info("Status pembayaran: belum_bayar");
    }

}

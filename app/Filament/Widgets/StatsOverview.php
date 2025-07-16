<?php

namespace App\Filament\Widgets;

use App\Models\kamar;
use App\Models\laporan;
use App\Models\Payment;
use App\Models\Tagihan;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Users', User::withoutTrashed()->count())
                ->label('Penghuni')
                ->description('Penghuni Aktif')
                ->descriptionIcon('heroicon-m-users')
                ->color('success')
                ->icon('heroicon-o-users'),
                
            Stat::make('Kamars', kamar::count())
                ->label('Kamar')
                ->description('Total Kamar')
                ->descriptionIcon('heroicon-m-home')
                ->color('info')
                ->icon('heroicon-o-home'),
                
            Stat::make('Tagihan', Tagihan::where('status', 'pending')->count())
                ->label('Tagihan')
                ->description('Total Tagihan Belum Dibayar')
                ->descriptionIcon('heroicon-m-document-text')
                ->color('warning')
                ->icon('heroicon-o-document-text'),
                
            Stat::make('Laporan', laporan::count())
                ->label('Laporan')
                ->description('Total Laporan Dibuat')
                ->descriptionIcon('heroicon-m-chart-bar')
                ->color('primary')
                ->icon('heroicon-o-chart-bar'),
                
            Stat::make('Pembayaran', Payment::count())
                ->label('Pembayaran')
                ->description('Total pembayaran')
                ->descriptionIcon('heroicon-m-banknotes')
                ->color('danger')
                ->icon('heroicon-o-banknotes'),
        ];
}
}

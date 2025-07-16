<?php

namespace App\Filament\Widgets;

use Carbon\Carbon;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class MonthlyRevenueChart extends ChartWidget
{
    protected static ?string $heading = 'Pendapatan Bulanan';

    protected function getData(): array
    {
        $revenue = DB::table('payments')
            ->join('tagihans', 'payments.tagihan_id', '=', 'tagihans.id')
            ->selectRaw('MONTH(payments.created_at) as month, SUM(tagihans.jumlah_tagihan) as total')
            ->whereYear('payments.created_at', now()->year)
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month')
            ->mapWithKeys(fn ($item, $key) => [(int) $key => $item]); // ensure keys are integers

        $months = collect(range(1, 12))->map(fn ($month) =>
            \Carbon\Carbon::create()->month($month)->format('F')
        );

        $values = $months->map(fn ($_, $index) => $revenue[$index + 1] ?? 0);

        return [
            'datasets' => [
                [
                    'label' => 'Pendapatan',
                    'data' => $values,
                    'backgroundColor' => 'rgba(53, 162, 235, 0.5)',
                    'borderColor' => 'rgb(53, 162, 235)',
                    'borderWidth' => 1,
                ],
            ],
            'labels' => $months->toArray(),
        ];
    }


    protected function getType(): string
    {
        return 'bar';
    }
}

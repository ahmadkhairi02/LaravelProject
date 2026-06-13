<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use Filament\Widgets\ChartWidget;

class RevenueChart extends ChartWidget
{
    protected static ?string $heading = 'Monthly Revenue';
    protected static ?int    $sort    = 2;

    protected function getData(): array
    {
        $months = collect(range(5, 0))->map(fn ($i) => now()->subMonths($i));

        $revenue = $months->map(fn ($month) => (float) Order::whereNotIn('status', ['cancelled'])
            ->whereYear('created_at', $month->year)
            ->whereMonth('created_at', $month->month)
            ->sum('total_amount')
        );

        return [
            'datasets' => [
                [
                    'label'           => 'Revenue ($)',
                    'data'            => $revenue->values()->toArray(),
                    'backgroundColor' => 'rgba(217, 119, 6, 0.15)',
                    'borderColor'     => 'rgb(217, 119, 6)',
                    'borderWidth'     => 2,
                    'tension'         => 0.4,
                    'fill'            => true,
                    'pointBackgroundColor' => 'rgb(217, 119, 6)',
                ],
            ],
            'labels' => $months->map(fn ($m) => $m->format('M Y'))->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}

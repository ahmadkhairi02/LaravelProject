<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $revenue = Order::whereNotIn('status', ['cancelled'])->sum('total_amount');

        return [
            Stat::make('Total Orders', Order::count())
                ->description('All time orders')
                ->descriptionIcon('heroicon-m-shopping-bag')
                ->color('primary'),

            Stat::make('Pending', Order::where('status', 'pending')->count())
                ->description('Awaiting processing')
                ->descriptionIcon('heroicon-m-clock')
                ->color('warning'),

            Stat::make('Delivered', Order::where('status', 'delivered')->count())
                ->description('Successfully fulfilled')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('success'),

            Stat::make('Cancelled', Order::where('status', 'cancelled')->count())
                ->description('Orders cancelled')
                ->descriptionIcon('heroicon-m-x-circle')
                ->color('danger'),

            Stat::make('Total Revenue', '$' . number_format($revenue, 2))
                ->description('Excluding cancelled orders')
                ->descriptionIcon('heroicon-m-currency-dollar')
                ->color('success'),
        ];
    }
}

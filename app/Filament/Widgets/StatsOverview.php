<?php

namespace App\Filament\Widgets;

use App\Models\Client;
use App\Models\Request;
use App\Models\Solving;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $total_client = Client::countClient();
        $total_request = Request::countRequestNotDone();
        $total_solved = Solving::countSolvingDone();
        $new_client = Client::Newclient()->count();
        $percentage_new_client = ($total_client != 0) ? ($new_client / $total_client) * 100 : 0;

        return [
            Stat::make('Total Client', $total_client),
            Stat::make('Request need resolve', $total_request),
            Stat::make('Solved', $total_solved),
            Stat::make('New client', $new_client)
                ->description(number_format($percentage_new_client, 1) . '% increase')
                ->color('success')
                ->descriptionIcon('heroicon-m-arrow-trending-up'),
        ];
    }
}

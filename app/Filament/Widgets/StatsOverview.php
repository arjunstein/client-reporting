<?php

namespace App\Filament\Widgets;

use App\Models\Client;
use App\Models\Request;
use App\Models\Solving;
use Carbon\Carbon;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\Concerns\InteractsWithPageFilters;

class StatsOverview extends BaseWidget
{
    use InteractsWithPageFilters;

    protected function getStats(): array
    {
        $startDate = !is_null($this->filters['startDate'] ?? null) ?
            Carbon::parse($this->filters['startDate']) :
            null;

        $endDate = !is_null($this->filters['endDate'] ?? null) ?
            Carbon::parse($this->filters['endDate']) :
            now();

        $total_client = Client::whereBetween('created_at', [$startDate, $endDate])->count();
        $total_request = Request::countRequestNotDone()->whereBetween('created_at', [$startDate, $endDate])->count();
        $total_solved = Solving::countSolvingDone()->whereBetween('created_at', [$startDate, $endDate])->count();
        $new_client = Client::Newclient()->whereBetween('created_at', [$startDate, $endDate])->count();
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

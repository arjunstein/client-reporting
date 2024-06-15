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

        $all_client = Client::count();
        $need_resolve = Request::countRequestNotDone()->count();
        $total_solved = Solving::countSolvingDone()->count();
        $new_client = Client::getNewClient()->count();

        if (is_null($startDate)) {
            $total_client_filter = $all_client;
            $total_filter_need_resolve = $need_resolve;
            $total_filter_solved = $total_solved;
            $total_filter_new_client = $new_client;
            $percentage_all_new_client = ($all_client != 0) ? ($new_client / $all_client) * 100 : 0;
        } else {
            $total_client_filter = Client::whereBetween('created_at', [$startDate, $endDate])->count();
            $total_filter_need_resolve = Request::countRequestNotDone()->whereBetween('created_at', [$startDate, $endDate])->count();
            $total_filter_solved = Solving::countSolvingDone()->whereBetween('created_at', [$startDate, $endDate])->count();
            $total_filter_new_client = Client::getNewClient()->whereBetween('created_at', [$startDate, $endDate])->count();
            $percentage_all_new_client = ($total_client_filter != 0) ? ($total_filter_new_client / $total_client_filter) * 100 : 0;
        }

        return [
            Stat::make('Total Client', $total_client_filter),
            Stat::make('Request need resolve', $total_filter_need_resolve),
            Stat::make('Solved', $total_filter_solved),
            Stat::make('New client', $total_filter_new_client)
                ->description(number_format($percentage_all_new_client, 1) . '% increase')
                ->color('success')
                ->descriptionIcon('heroicon-m-arrow-trending-up'),
        ];
    }
}

<?php

namespace App\Filament\Widgets;

use App\Models\Request;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class W_MonthlyRequestChart extends ChartWidget
{
    protected static ?string $heading;
    protected static string $color = 'success';
    public ?string $filter = 'month';

    public function __construct()
    {
        self::$heading = 'Total request';
    }

    protected function getFilters(): ?array
    {
        return [
            'month' => date('F Y'),
            'year' => 'Total in ' . date('Y'),
        ];
    }

    protected function getData(): array
    {
        $activeFilter = $this->filter;
        $start = match ($activeFilter) {
            'month' => now()->startOfMonth(),
            'year' => now()->startOfYear(),
        };

        $end = match ($activeFilter) {
            'month' => now(),
            'year' => now(),
        };

        $trend = Trend::model(Request::class)
            ->dateColumn('request_date')
            ->between(
                start: $start,
                end: $end,
            );

        $data = match ($activeFilter) {
            'month' => $trend->perDay()->count(),
            'year' => $trend->perMonth()->count(),
        };

        return [
            'datasets' => [
                [
                    'label' => 'Request client',
                    'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
                ],
            ],
            'labels' => $data->map(fn (TrendValue $value) => $value->date),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}

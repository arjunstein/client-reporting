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

    public function __construct()
    {
        self::$heading = 'Total request in ' . now()->year;
    }

    protected function getData(): array
    {
        $data = Trend::model(Request::class)
            ->between(
                start: now()->startOfYear(),
                end: now()->endOfYear(),
            )
            ->perMonth()
            ->count();

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

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
        self::$heading = 'Total request';
    }

    protected function getData(): array
    {
        $data = Trend::model(Request::class)
            ->dateColumn('request_date')
            ->between(
                start: now()->startOfYear()->subYears(2),
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

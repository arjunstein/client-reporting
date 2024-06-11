<?php

namespace App\Filament\Widgets;

use App\Models\DevelopedList;
use App\Models\Request;
use App\Models\Solving;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class W_YearlyDevelopedChart extends ChartWidget
{
    protected static ?string $heading;

    public function __construct()
    {
        $year = \Carbon\Carbon::now()->year;
        $month = \Carbon\Carbon::now()->format('F');
        self::$heading = 'Most developed in ' . $month . ' ' . $year;
    }

    protected function getData(): array
    {
        $data = Solving::getAllDevelopedData();
        $developedList = DevelopedList::pluck('item_name', 'id');

        $labels = [];
        $counts = [];
        foreach ($data as $entry) {
            $labels[] = $developedList[$entry->developed_id] ?? 'Unknown';
            $counts[] = $entry->count;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Developed',
                    'data' => $counts,
                    'backgroundColor' => '#36A2EB',
                    'borderColor' => '#9BD0F5',
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}

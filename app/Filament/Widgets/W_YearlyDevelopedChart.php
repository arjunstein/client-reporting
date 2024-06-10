<?php

namespace App\Filament\Widgets;

use App\Models\DevelopedList;
use App\Models\Request;
use App\Models\Solving;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class W_YearlyDevelopedChart extends ChartWidget
{
    protected static ?string $heading;

    public function __construct()
    {
        self::$heading = 'Most developed in ' . now()->year;
    }

    protected function getData(): array
    {
        $data = Solving::getYearlyDevelopedData();

        $developedList = DevelopedList::pluck('item_name', 'id');

        $datasets = [];
        $labels = [];
        $counts = [];

        foreach ($data as $entry) {
            $labels[] = $developedList[$entry->developed_id] ?? ''; // Gunakan nama item atau 'Unknown' jika tidak ditemukan
            $counts[] = $entry->count;
        }

        $datasets[] = [
            'label' => $labels,
            'data' => $counts,
            'backgroundColor' => '#36A2EB',
            'borderColor' => '#9BD0F5',
        ];

        return [
            'datasets' => $datasets,
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}

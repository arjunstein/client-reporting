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
    public ?string $filter = 'year';

    public function __construct()
    {
        self::$heading = 'Most developed';
    }

    public function updateFilter($newFilter)
    {
        $this->filter = $newFilter;
    }

    protected function getFilters(): ?array
    {
        return [
            'month' => 'This month',
            'year' => 'This year',
        ];
    }

    protected function getData(): array
    {
        $activeFilter = $this->filter;
        $start = match ($activeFilter) {
            'month' => now()->startOfMonth(),
            'year' => now()->startOfYear(),
            default => now()->startOfYear(),
        };
        $end = now()->endOfYear();

        $data = Solving::getAllDevelopedData($start, $end);
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

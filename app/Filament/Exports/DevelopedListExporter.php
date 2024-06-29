<?php

namespace App\Filament\Exports;

use App\Models\DevelopedList;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class DevelopedListExporter extends Exporter
{
    protected static ?string $model = DevelopedList::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('item_name')
                ->label('Developed'),
            ExportColumn::make('description')
                ->label('Description'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your developed list export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}

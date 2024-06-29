<?php

namespace App\Filament\Exports;

use App\Models\Interfacing;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class InterfacingExporter extends Exporter
{
    protected static ?string $model = Interfacing::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('interfacing_name')
                ->label('Interfacing'),
            ExportColumn::make('description')
                ->label('Description'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your interfacing export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}

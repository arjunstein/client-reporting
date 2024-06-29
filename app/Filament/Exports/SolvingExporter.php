<?php

namespace App\Filament\Exports;

use App\Models\Solving;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class SolvingExporter extends Exporter
{
    protected static ?string $model = Solving::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('client.client_name')
                ->label('Client'),
            ExportColumn::make('developed.item_name')
                ->label('Developed'),
            ExportColumn::make('request.issue')
                ->label('Issue'),
            ExportColumn::make('resolving')
                ->label('Resolving'),
            ExportColumn::make('created_at')
                ->label('Finish Date'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your solving export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}

<?php

namespace App\Filament\Exports;

use App\Models\Request;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class RequestExporter extends Exporter
{
    protected static ?string $model = Request::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('issue')
                ->label('Issue'),
            ExportColumn::make('client.client_name')
                ->label('Client'),
            ExportColumn::make('status')
                ->label('Status'),
            ExportColumn::make('request_date')
                ->label('Request Date'),
            ExportColumn::make('finish_date')
                ->label('Finish Date'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your request export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}

<?php

namespace App\Filament\Exports;

use App\Models\Client;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class ClientExporter extends Exporter
{
    protected static ?string $model = Client::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('client_name')
                ->label('Client'),
            ExportColumn::make('is_client_new_text')
                ->label('New Client'),
            ExportColumn::make('interfacing.interfacing_name')
                ->label('Interfacing'),
            ExportColumn::make('ip_server')
                ->label('IP Server'),
            ExportColumn::make('created_at')
                ->label('Created at'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your client export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}

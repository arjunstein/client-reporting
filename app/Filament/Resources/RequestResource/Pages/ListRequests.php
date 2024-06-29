<?php

namespace App\Filament\Resources\RequestResource\Pages;

use App\Filament\Exports\RequestExporter;
use App\Filament\Resources\RequestResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Actions\Exports\Enums\ExportFormat;

class ListRequests extends ListRecords
{
    protected static string $resource = RequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\ExportAction::make()
                ->label('Export')
                ->color('success')
                ->exporter(RequestExporter::class)
                ->formats([
                    ExportFormat::Xlsx,
                    ExportFormat::Csv,
                ])
                ->maxRows(1000)
        ];
    }
}

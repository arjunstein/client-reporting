<?php

namespace App\Filament\Resources\ClientResource\Pages;

use App\Filament\Exports\ClientExporter;
use App\Filament\Resources\ClientResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Actions\Exports\Enums\ExportFormat;
use Filament\Resources\Pages\ListRecords;

class ListClients extends ListRecords
{
    protected static string $resource = ClientResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\ExportAction::make()
                ->label('Export')
                ->color('success')
                ->exporter(ClientExporter::class)
                ->formats([
                    ExportFormat::Xlsx,
                    ExportFormat::Csv,
                ])->maxRows(500)
        ];
    }
}

<?php

namespace App\Filament\Resources\SolvingResource\Pages;

use App\Filament\Exports\SolvingExporter;
use App\Filament\Resources\SolvingResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Actions\Exports\Enums\ExportFormat;

class ListSolvings extends ListRecords
{
    protected static string $resource = SolvingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\ExportAction::make()
                ->label('Export')
                ->color('success')
                ->exporter(SolvingExporter::class)
                ->formats([
                    ExportFormat::Xlsx,
                    ExportFormat::Csv,
                ])
                ->maxRows(1000),
        ];
    }
}

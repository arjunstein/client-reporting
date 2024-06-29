<?php

namespace App\Filament\Resources\InterfacingResource\Pages;

use App\Filament\Exports\InterfacingExporter;
use App\Filament\Resources\InterfacingResource;
use Filament\Actions;
use Filament\Actions\Exports\Enums\ExportFormat;
use Filament\Resources\Pages\ListRecords;

class ListInterfacings extends ListRecords
{
    protected static string $resource = InterfacingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\ExportAction::make()
                ->label('Export')
                ->color('success')
                ->exporter(InterfacingExporter::class)
                ->formats([
                    ExportFormat::Xlsx,
                    ExportFormat::Csv,
                ])->maxRows(100)
        ];
    }
}

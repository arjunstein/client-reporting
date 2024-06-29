<?php

namespace App\Filament\Resources\DevelopedListResource\Pages;

use App\Filament\Exports\DevelopedListExporter;
use App\Filament\Resources\DevelopedListResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Actions\Exports\Enums\ExportFormat;

class ListDevelopedLists extends ListRecords
{
    protected static string $resource = DevelopedListResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\ExportAction::make()
                ->label('Export')
                ->color('success')
                ->exporter(DevelopedListExporter::class)
                ->formats([
                    ExportFormat::Xlsx,
                    ExportFormat::Csv,
                ])->maxRows(100),
        ];
    }
}

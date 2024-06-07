<?php

namespace App\Filament\Resources\InterfacingResource\Pages;

use App\Filament\Resources\InterfacingResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListInterfacings extends ListRecords
{
    protected static string $resource = InterfacingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

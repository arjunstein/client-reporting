<?php

namespace App\Filament\Resources\SolvingResource\Pages;

use App\Filament\Resources\SolvingResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSolvings extends ListRecords
{
    protected static string $resource = SolvingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

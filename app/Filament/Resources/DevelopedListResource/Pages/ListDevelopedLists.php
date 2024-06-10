<?php

namespace App\Filament\Resources\DevelopedListResource\Pages;

use App\Filament\Resources\DevelopedListResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDevelopedLists extends ListRecords
{
    protected static string $resource = DevelopedListResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

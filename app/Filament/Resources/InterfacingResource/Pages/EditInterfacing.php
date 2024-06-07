<?php

namespace App\Filament\Resources\InterfacingResource\Pages;

use App\Filament\Resources\InterfacingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditInterfacing extends EditRecord
{
    protected static string $resource = InterfacingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

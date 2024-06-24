<?php

namespace App\Filament\Resources\SolvingResource\Pages;

use App\Filament\Resources\SolvingResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateSolving extends CreateRecord
{
    protected static string $resource = SolvingResource::class;

    protected function afterCreate(): void
    {
        $this->record->updateStatus();
    }
}

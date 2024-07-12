<?php

namespace App\Filament\Resources\SolvingResource\Pages;

use App\Filament\Resources\SolvingResource;
use Filament\Resources\Pages\EditRecord;
use Filament\Notifications\Notification;

class EditSolving extends EditRecord
{
    protected static string $resource = SolvingResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getSavedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Solve updated')
            ->body('The request solve has been updated successfully.');
    }
}

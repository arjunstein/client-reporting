<?php

namespace App\Filament\Resources\InterfacingResource\Pages;

use App\Filament\Resources\InterfacingResource;
use Filament\Resources\Pages\EditRecord;
use Filament\Notifications\Notification;

class EditInterfacing extends EditRecord
{
    protected static string $resource = InterfacingResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getSavedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Interfacing updated')
            ->body('The interfacing has been updated successfully.');
    }
}

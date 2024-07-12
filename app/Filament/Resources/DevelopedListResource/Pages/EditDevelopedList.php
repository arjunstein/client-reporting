<?php

namespace App\Filament\Resources\DevelopedListResource\Pages;

use App\Filament\Resources\DevelopedListResource;
use Filament\Resources\Pages\EditRecord;
use Filament\Notifications\Notification;

class EditDevelopedList extends EditRecord
{
    protected static string $resource = DevelopedListResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getSavedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Developed list updated')
            ->body('The developed list has been updated successfully.');
    }
}

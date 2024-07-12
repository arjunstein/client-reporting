<?php

namespace App\Filament\Resources\DevelopedListResource\Pages;

use App\Filament\Resources\DevelopedListResource;
use Filament\Resources\Pages\CreateRecord;
use Filament\Notifications\Notification;

class CreateDevelopedList extends CreateRecord
{
    protected static string $resource = DevelopedListResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Developed list created')
            ->body('The developed list has been created successfully.');
    }
}

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
        $developedList = $this->record;

        return Notification::make()
            ->success()
            ->title('Success')
            ->body("{$developedList->item_name} has been created");
    }
}

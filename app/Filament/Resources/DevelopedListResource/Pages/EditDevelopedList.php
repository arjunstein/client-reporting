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
        $developedList = $this->record;

        return Notification::make()
            ->success()
            ->title('Edited')
            ->body("{$developedList->item_name} has been updated");
    }
}

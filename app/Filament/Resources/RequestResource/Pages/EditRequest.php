<?php

namespace App\Filament\Resources\RequestResource\Pages;

use App\Filament\Resources\RequestResource;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

class EditRequest extends EditRecord
{
    protected static string $resource = RequestResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getSavedNotification(): ?Notification
    {
        $requestCreated = $this->record;

        return Notification::make()
            ->success()
            ->title('Edited')
            ->body("Updated request client {$requestCreated->client->client_name}");
    }
}

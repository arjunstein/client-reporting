<?php

namespace App\Filament\Resources\RequestResource\Pages;

use App\Filament\Resources\RequestResource;
use App\Models\User;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;

class CreateRequest extends CreateRecord
{
    protected static string $resource = RequestResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotification(): ?Notification
    {
        $recipient = User::all();
        $requestCreated = $this->record;

        return Notification::make()
            ->success()
            ->title('New request')
            ->body("Client: {$requestCreated->client->client_name}, Issue: {$requestCreated->issue}")
            ->sendToDatabase($recipient);
    }
}

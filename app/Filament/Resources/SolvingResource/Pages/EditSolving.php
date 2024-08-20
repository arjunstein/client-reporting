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
        $solving = $this->record;

        return Notification::make()
            ->success()
            ->title('Edited')
            ->body("Request: '{$solving->request->issue}' Client: '{$solving->client->client_name}' has been updated.");
    }
}

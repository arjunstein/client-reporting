<?php

namespace App\Filament\Resources\SolvingResource\Pages;

use App\Filament\Resources\SolvingResource;
use App\Models\User;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;

class CreateSolving extends CreateRecord
{
    protected static string $resource = SolvingResource::class;

    protected function afterCreate(): void
    {
        $this->record->updateStatus();
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotification(): ?Notification
    {
        $recipient = User::all();
        return Notification::make()
            ->success()
            ->title('Solved')
            ->body('The request has been solved successfully.')
            ->sendToDatabase($recipient);
    }
}

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
        $interfacing = $this->record;

        return Notification::make()
            ->success()
            ->title('Edited')
            ->body("Interfacing {$interfacing->interfacing_name} has been updated");
    }
}

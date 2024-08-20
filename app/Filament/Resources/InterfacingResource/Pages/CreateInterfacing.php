<?php

namespace App\Filament\Resources\InterfacingResource\Pages;

use App\Filament\Resources\InterfacingResource;
use Filament\Resources\Pages\CreateRecord;
use Filament\Notifications\Notification;

class CreateInterfacing extends CreateRecord
{
    protected static string $resource = InterfacingResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotification(): ?Notification
    {
        $interfacing = $this->record;

        return Notification::make()
            ->success()
            ->title('Success')
            ->body("Interfacing {$interfacing->interfacing_name} has been created");
    }
}

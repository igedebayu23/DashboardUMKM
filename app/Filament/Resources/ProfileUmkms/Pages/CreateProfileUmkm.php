<?php

namespace App\Filament\Resources\ProfileUmkms\Pages;

use App\Filament\Resources\ProfileUmkms\ProfileUmkmResource;
use Filament\Actions\Action;
use Filament\Resources\Pages\CreateRecord;

class CreateProfileUmkm extends CreateRecord
{
    protected static string $resource = ProfileUmkmResource::class;

    protected static ?string $title = 'Tambahkan Profile UMKM';

    protected function getFormActions(): array
    {
        return [
            $this->getCreateAnotherFormAction()
                ->label('Tambahkan'),
            $this->getCancelFormAction(),
        ];
    }

    protected function getCancelFormAction(): Action
    {
        $action = parent::getCancelFormAction()
            ->label('Batal');

        if (auth()->user()?->isPesertaMagang()) {
            $action->url(static::getResource()::getUrl('create'));
        }

        return $action;
    }

    protected function getRedirectUrl(): string
    {
        if (auth()->user()?->isPesertaMagang()) {
            return static::getResource()::getUrl('create');
        }

        return parent::getRedirectUrl();
    }

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Profile UMKM berhasil ditambahkan.';
    }
}

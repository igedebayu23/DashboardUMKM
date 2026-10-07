<?php

namespace App\Filament\Resources\ProfileUmkms\Pages;

use App\Filament\Resources\ProfileUmkms\ProfileUmkmResource;
use Filament\Resources\Pages\CreateRecord;
use Filament\Actions\Action;

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
        return parent::getCancelFormAction()
            ->label('Batal');
    }

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Profile UMKM berhasil ditambahkan.';
    }
}

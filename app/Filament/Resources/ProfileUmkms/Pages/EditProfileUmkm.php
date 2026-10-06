<?php

namespace App\Filament\Resources\ProfileUmkms\Pages;

use App\Filament\Resources\ProfileUmkms\ProfileUmkmResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditProfileUmkm extends EditRecord
{
    protected static string $resource = ProfileUmkmResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}

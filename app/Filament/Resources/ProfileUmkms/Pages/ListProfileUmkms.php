<?php

namespace App\Filament\Resources\ProfileUmkms\Pages;

use App\Filament\Resources\ProfileUmkms\ProfileUmkmResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListProfileUmkms extends ListRecords
{
    protected static string $resource = ProfileUmkmResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}

<?php

namespace App\Filament\Resources\LaporanKeuanganUmkms\Pages;

use App\Filament\Resources\LaporanKeuanganUmkms\LaporanKeuanganUmkmResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditLaporanKeuanganUmkm extends EditRecord
{
    protected static string $resource = LaporanKeuanganUmkmResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}

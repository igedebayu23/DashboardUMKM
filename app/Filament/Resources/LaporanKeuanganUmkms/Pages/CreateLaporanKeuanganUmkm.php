<?php

namespace App\Filament\Resources\LaporanKeuanganUmkms\Pages;

use App\Filament\Resources\LaporanKeuanganUmkms\LaporanKeuanganUmkmResource;
use Filament\Resources\Pages\CreateRecord;
use Filament\Actions\Action;

class CreateLaporanKeuanganUmkm extends CreateRecord
{
    protected static string $resource = LaporanKeuanganUmkmResource::class;

    protected static ?string $title = 'Tambahkan Laporan Keuangan UMKM';

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
        return 'Laporan keuangan UMKM berhasil ditambahkan.';
    }
}

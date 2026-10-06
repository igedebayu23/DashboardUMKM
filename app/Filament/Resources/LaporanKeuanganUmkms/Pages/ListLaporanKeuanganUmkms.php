<?php

namespace App\Filament\Resources\LaporanKeuanganUmkms\Pages;

use App\Filament\Resources\LaporanKeuanganUmkms\LaporanKeuanganUmkmResource;
use App\Models\laporanKeuanganUmkm;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Livewire\Attributes\Url;

class ListLaporanKeuanganUmkms extends ListRecords
{
    protected static string $resource = LaporanKeuanganUmkmResource::class;

    #[Url]
    public ?int $umkmId = null;

    protected function getTableQuery(): Builder
    {
        $query = laporanKeuanganUmkm::query();

        if (filled($this->umkmId)) {
            return $query->where('umkm_id', $this->umkmId);
        }

        return $query->whereIn('laporan_id', function (QueryBuilder $subquery): void {
            $subquery
                ->selectRaw('MIN(laporan_id)')
                ->from('laporan_keuangan_umkm')
                ->groupBy('umkm_id');
        });
    }

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}

<?php

namespace App\Filament\Pages;

use App\Models\ProfileUmkm;
use Filament\Pages\Page;
use Livewire\Attributes\Computed;
use UnitEnum;

class GrafikPendapatanTahunan extends Page
{
    protected static string|UnitEnum|null $navigationGroup = 'Analisis';

    protected static ?string $navigationLabel = 'Grafik Pendapatan Tahunan';

    protected static ?string $title = 'Grafik Pendapatan Tahunan';

    protected static ?int $navigationSort = 1;

    public ?int $selectedUmkm = null;

    public static function canAccess(): bool
    {
        return (bool) (auth()->user()?->isAdmin() || auth()->user()?->isPimpinan());
    }

    public function mount(): void
    {
        $firstUmkm = ProfileUmkm::query()
            ->orderBy('nama_umkm')
            ->value('umkm_id');

        $this->selectedUmkm = $firstUmkm !== null ? (int) $firstUmkm : null;
    }

    /**
     * @return array<int, string>
     */
    #[Computed]
    public function umkmOptions(): array
    {
        return ProfileUmkm::query()
            ->orderBy('nama_umkm')
            ->pluck('nama_umkm', 'umkm_id')
            ->all();
    }

    /**
     * @return array<int, string>
     */
    public function getUmkmOptions(): array
    {
        return $this->umkmOptions();
    }

    protected string $view = 'filament.pages.grafik-pendapatan-tahunan';
}

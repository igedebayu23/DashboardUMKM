<?php

namespace App\Filament\Widgets;

use App\Models\ProfileUmkm;
use App\Services\UmkmRevenueAnalysisService;
use Filament\Widgets\ChartWidget;
use Illuminate\Contracts\Support\Htmlable;

class PendapatanTahunanChart extends ChartWidget
{
    public ?int $umkmId = null;

    protected static ?int $sort = 1;

    protected int|string|array $columnSpan = 'full';

    protected ?string $heading = 'Total Pendapatan per Tahun';

    protected ?string $description = 'Jumlah pendapatan seluruh UMKM berdasarkan tahun.';

    protected string $color = 'primary';

    public function mount(?int $umkmId = null): void
    {
        $this->umkmId = $umkmId;
        parent::mount();
    }

    public function getHeading(): string|Htmlable|null
    {
        if ($this->umkmId !== null) {
            $nama = ProfileUmkm::query()->where('umkm_id', $this->umkmId)->value('nama_umkm');

            if ($nama) {
                return "Pendapatan per Tahun - {$nama}";
            }
        }

        return $this->heading;
    }

    public function getDescription(): string|Htmlable|null
    {
        if ($this->umkmId !== null) {
            $nama = ProfileUmkm::query()->where('umkm_id', $this->umkmId)->value('nama_umkm');

            if ($nama) {
                return "Jumlah pendapatan {$nama} berdasarkan tahun.";
            }
        }

        return $this->description;
    }

    public function isEmpty(): bool
    {
        $data = $this->getCachedData();

        return empty($data['datasets'][0]['data'] ?? []);
    }

    public function getEmptyStateHeading(): string|Htmlable
    {
        return 'Tidak ada data laporan keuangan';
    }

    public function getEmptyStateDescription(): string|Htmlable|null
    {
        return 'Belum ada data pendapatan tahunan untuk UMKM ini.';
    }

    protected function getType(): string
    {
        return 'bar';
    }

    protected function getData(): array
    {
        $annualData = resolve(UmkmRevenueAnalysisService::class)->annualRevenue($this->umkmId);

        return [
            'labels' => $annualData->pluck('tahun')->map(fn (int $year): string => (string) $year)->all(),
            'datasets' => [
                [
                    'label' => 'Pendapatan',
                    'data' => $annualData->pluck('total')->map(fn (float $total): float => $total)->all(),
                    'backgroundColor' => '#f59e0b',
                    'borderColor' => '#d97706',
                    'borderWidth' => 1,
                ],
            ],
        ];
    }

    protected function getOptions(): array
    {
        return [
            'plugins' => [
                'legend' => [
                    'display' => false,
                ],
            ],
            'scales' => [
                'y' => [
                    'beginAtZero' => true,
                ],
            ],
        ];
    }
}

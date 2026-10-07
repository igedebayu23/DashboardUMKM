<?php

namespace App\Filament\Widgets;

use App\Models\laporanKeuanganUmkm;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class PendapatanTahunanChart extends ChartWidget
{
    protected ?string $heading = 'Total Pendapatan per Tahun';

    protected ?string $description = 'Jumlah pendapatan seluruh UMKM berdasarkan tahun.';

    protected string $color = 'primary';

    protected function getType(): string
    {
        return 'bar';
    }

    protected function getData(): array
    {
        $annualData = laporanKeuanganUmkm::query()
            ->select('tahun', DB::raw('SUM(pendapatan) as total'))
            ->groupBy('tahun')
            ->orderBy('tahun')
            ->get();

        return [
            'labels' => $annualData->pluck('tahun')->map(fn (mixed $year): string => (string) $year)->all(),
            'datasets' => [
                [
                    'label' => 'Pendapatan',
                    'data' => $annualData->pluck('total')->map(fn (mixed $total): float => (float) $total)->all(),
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

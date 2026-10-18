<?php

namespace App\Filament\Widgets;

use App\Services\UmkmRevenueAnalysisService;
use Filament\Widgets\ChartWidget;

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
        $annualData = resolve(UmkmRevenueAnalysisService::class)->annualRevenue();

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

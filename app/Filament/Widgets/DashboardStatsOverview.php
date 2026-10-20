<?php

namespace App\Filament\Widgets;

use App\Models\LaporanKeuanganUmkm;
use App\Models\ProfileUmkm;
use Filament\Support\Icons\Heroicon;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class DashboardStatsOverview extends StatsOverviewWidget
{
    protected static ?int $sort = 0;

    protected ?string $heading = 'Ringkasan UMKM';

    protected function getStats(): array
    {
        $latestYear = LaporanKeuanganUmkm::query()->max('tahun');
        $latestRevenue = $latestYear === null
            ? 0
            : (float) LaporanKeuanganUmkm::query()
                ->where('tahun', $latestYear)
                ->sum('pendapatan');

        return [
            Stat::make('Jumlah UMKM Binaan', ProfileUmkm::query()->count())
                ->description('Total UMKM yang terdaftar')
                ->descriptionIcon(Heroicon::OutlinedBuildingStorefront)
                ->color('primary')
                ->icon(Heroicon::OutlinedBuildingStorefront),
            Stat::make(
                'Total Pendapatan '.($latestYear === null ? 'Terbaru' : $latestYear),
                'Rp '.number_format($latestRevenue, 0, ',', '.'),
            )
                ->description($latestYear === null ? 'Belum ada laporan keuangan' : 'Akumulasi seluruh laporan tahunan')
                ->descriptionIcon(Heroicon::OutlinedBanknotes)
                ->color('success')
                ->icon(Heroicon::OutlinedBanknotes),
            Stat::make('UMKM Mengalami Penurunan', count(LaporanKeuanganUmkm::getAnalisisPenurunan()))
                ->description('Berdasarkan perbandingan tahun terakhir')
                ->descriptionIcon(Heroicon::OutlinedArrowTrendingDown)
                ->color('danger')
                ->icon(Heroicon::OutlinedArrowTrendingDown),
        ];
    }
}

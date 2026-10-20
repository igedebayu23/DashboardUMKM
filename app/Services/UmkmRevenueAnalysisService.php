<?php

namespace App\Services;

use App\Models\LaporanKeuanganUmkm;
use Illuminate\Support\Collection;

class UmkmRevenueAnalysisService
{
    /**
     * @return Collection<int, array{tahun: int, total: float}>
     */
    public function annualRevenue(): Collection
    {
        return LaporanKeuanganUmkm::getGrafikTahunan();
    }

    /**
     * @return array<int, array{
     *     nama_umkm: string,
     *     tahun_sebelumnya: int,
     *     pendapatan_sebelumnya: float,
     *     tahun: int,
     *     pendapatan: float,
     *     penurunan: float
     * }>
     */
    public function decliningUmkms(): array
    {
        return LaporanKeuanganUmkm::getAnalisisPenurunan();
    }
}

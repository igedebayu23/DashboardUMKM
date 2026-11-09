<?php

namespace App\Http\Controllers;

use App\Models\LaporanKeuanganUmkm;
use App\Models\ProfileUmkm;
use App\Services\UmkmRevenueAnalysisService;
use Illuminate\Contracts\View\View;

class DashboardController extends Controller
{
    public function __invoke(UmkmRevenueAnalysisService $analysis): View
    {
        $latestYear = LaporanKeuanganUmkm::query()->max('tahun');

        return view('dashboard.index', [
            'umkmCount' => ProfileUmkm::query()->count(),
            'latestYear' => $latestYear,
            'latestRevenue' => $latestYear === null
                ? 0
                : (float) LaporanKeuanganUmkm::query()->where('tahun', $latestYear)->sum('pendapatan'),
            'decliningCount' => count($analysis->decliningUmkms()),
            'annualRevenue' => $analysis->annualRevenue(),
        ]);
    }
}

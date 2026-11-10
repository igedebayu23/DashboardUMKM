<?php

namespace App\Http\Controllers;

use App\Models\ProfileUmkm;
use App\Services\UmkmRevenueAnalysisService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AnalisisController extends Controller
{
    public function annualRevenue(Request $request, UmkmRevenueAnalysisService $analysis): View
    {
        $selectedUmkm = $request->integer('umkm_id') ?: null;

        return view('analisis.pendapatan', [
            'profiles' => ProfileUmkm::query()->orderBy('nama_umkm')->get(['umkm_id', 'nama_umkm']),
            'selectedUmkm' => $selectedUmkm,
            'annualRevenue' => $analysis->annualRevenue($selectedUmkm),
        ]);
    }

    public function declining(UmkmRevenueAnalysisService $analysis): View
    {
        return view('analisis.penurunan', [
            'decliningUmkms' => $analysis->decliningUmkms(),
        ]);
    }
}

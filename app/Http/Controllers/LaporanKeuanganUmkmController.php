<?php

namespace App\Http\Controllers;

use App\Models\LaporanKeuanganUmkm;
use App\Models\ProfileUmkm;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class LaporanKeuanganUmkmController extends Controller
{
    public function index(Request $request): View
    {
        $reports = LaporanKeuanganUmkm::query()
            ->with('umkm')
            ->when($request->integer('umkm_id'), fn ($query, int $id) => $query->where('umkm_id', $id))
            ->when($request->integer('tahun'), fn ($query, int $year) => $query->where('tahun', $year))
            ->latest('tahun')
            ->latest('laporan_id')
            ->paginate(15)
            ->withQueryString();

        return view('laporan-keuangan.index', [
            'reports' => $reports,
            'profiles' => ProfileUmkm::query()->orderBy('nama_umkm')->get(['umkm_id', 'nama_umkm']),
        ]);
    }

    public function create(): View
    {
        return view('laporan-keuangan.form', [
            'report' => new LaporanKeuanganUmkm,
            'profiles' => ProfileUmkm::query()->orderBy('nama_umkm')->get(['umkm_id', 'nama_umkm']),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        LaporanKeuanganUmkm::create($this->validated($request));

        $destination = $request->user()?->isPesertaMagang()
            ? 'laporan-keuangan.create'
            : 'laporan-keuangan.index';

        return redirect()->route($destination)->with('success', 'Laporan keuangan berhasil ditambahkan.');
    }

    public function edit(LaporanKeuanganUmkm $laporanKeuangan): View
    {
        Gate::authorize('update', $laporanKeuangan);

        return view('laporan-keuangan.form', [
            'report' => $laporanKeuangan,
            'profiles' => ProfileUmkm::query()->orderBy('nama_umkm')->get(['umkm_id', 'nama_umkm']),
        ]);
    }

    public function update(Request $request, LaporanKeuanganUmkm $laporanKeuangan): RedirectResponse
    {
        Gate::authorize('update', $laporanKeuangan);
        $laporanKeuangan->update($this->validated($request, $laporanKeuangan));

        return redirect()->route('laporan-keuangan.index')->with('success', 'Laporan keuangan berhasil diperbarui.');
    }

    public function destroy(LaporanKeuanganUmkm $laporanKeuangan): RedirectResponse
    {
        Gate::authorize('delete', $laporanKeuangan);
        $laporanKeuangan->delete();

        return back()->with('success', 'Laporan keuangan berhasil dihapus.');
    }

    /**
     * @return array<string, mixed>
     */
    private function validated(Request $request, ?LaporanKeuanganUmkm $report = null): array
    {
        $validated = $request->validate([
            'umkm_id' => ['required', 'integer', 'exists:profile_umkm,umkm_id'],
            'tahun' => ['required', 'integer', 'min:2021', 'max:9999'],
            'bulan' => ['required', Rule::in([
                'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember',
            ])],
            'pendapatan' => ['required', 'numeric', 'min:0'],
        ]);

        $duplicate = LaporanKeuanganUmkm::query()
            ->where('umkm_id', $validated['umkm_id'])
            ->where('tahun', $validated['tahun'])
            ->where('bulan', $validated['bulan'])
            ->when($report, fn ($query) => $query->where('laporan_id', '!=', $report->getKey()))
            ->exists();

        if ($duplicate) {
            throw ValidationException::withMessages([
                'umkm_id' => 'Laporan untuk UMKM, tahun, dan bulan tersebut sudah ada.',
            ]);
        }

        return $validated;
    }
}

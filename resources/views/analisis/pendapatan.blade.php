<x-layouts.app title="Grafik Pendapatan Tahunan">
    <!-- Filter Card -->
    <div class="mb-6 rounded-2xl border border-slate-200/80 bg-white p-5 shadow-xs">
        <form method="GET" action="{{ route('analisis.pendapatan') }}" class="flex flex-wrap items-end gap-3">
            <div class="w-full sm:w-72">
                <label for="umkm_id" class="mb-1.5 block text-xs font-semibold uppercase tracking-wider text-slate-500">Pilih UMKM</label>
                <div class="relative">
                    <select id="umkm_id" name="umkm_id" class="w-full appearance-none rounded-xl border border-slate-300 bg-slate-50/50 px-4 py-2.5 pr-10 text-sm font-medium text-slate-700 transition focus:border-amber-500 focus:bg-white focus:outline-none focus:ring-2 focus:ring-amber-500/20">
                        <option value="">Semua UMKM (Konsolidasi)</option>
                        @foreach ($profiles as $profile)
                            <option value="{{ $profile->umkm_id }}" @selected($selectedUmkm === $profile->umkm_id)>{{ $profile->nama_umkm }}</option>
                        @endforeach
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-slate-400">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </div>
                </div>
            </div>
            <button type="submit" class="inline-flex items-center gap-2 rounded-xl bg-amber-500 px-5 py-2.5 text-sm font-bold text-slate-950 shadow-xs transition hover:bg-amber-400 hover:shadow-md focus:outline-none focus:ring-2 focus:ring-amber-500/30">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                Tampilkan
            </button>
            @if ($selectedUmkm)
                <a href="{{ route('analisis.pendapatan') }}" class="rounded-xl border border-slate-200 px-4 py-2.5 text-sm font-semibold text-slate-600 hover:bg-slate-50">Reset</a>
            @endif
        </form>
    </div>

    <!-- Quick Stats Summary Cards -->
    @if ($annualRevenue->isNotEmpty())
        @php
            $totalAccumulated = $annualRevenue->sum('total');
            $avgRevenue = $annualRevenue->avg('total');
            $topYear = $annualRevenue->sortByDesc('total')->first();
        @endphp
        <div class="mb-6 grid grid-cols-1 gap-4 sm:grid-cols-3">
            <div class="rounded-2xl border border-slate-200/80 bg-white p-5 shadow-xs">
                <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">Total Akumulasi</p>
                <p class="mt-2 text-xl font-extrabold text-slate-900">Rp {{ number_format($totalAccumulated, 0, ',', '.') }}</p>
                <p class="mt-1 text-xs text-slate-500">{{ $annualRevenue->count() }} periode laporan tercatat</p>
            </div>
            <div class="rounded-2xl border border-slate-200/80 bg-white p-5 shadow-xs">
                <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">Rata-rata Pendapatan / Tahun</p>
                <p class="mt-2 text-xl font-extrabold text-slate-900">Rp {{ number_format($avgRevenue, 0, ',', '.') }}</p>
                <p class="mt-1 text-xs text-slate-500">Rata-rata kinerja tahunan</p>
            </div>
            <div class="rounded-2xl border border-slate-200/80 bg-white p-5 shadow-xs">
                <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">Pendapatan Tertinggi</p>
                <p class="mt-2 text-xl font-extrabold text-amber-600">Rp {{ number_format($topYear->total, 0, ',', '.') }}</p>
                <p class="mt-1 text-xs font-medium text-slate-600">Dicapai pada tahun <span class="font-bold text-slate-900">{{ $topYear->tahun }}</span></p>
            </div>
        </div>
    @endif

    <!-- Main Chart Card (Expands cleanly to fill width) -->
    <div class="rounded-2xl border border-slate-200/80 bg-white p-6 shadow-xs">
        <div class="flex flex-wrap items-center justify-between gap-3 border-b border-slate-100 pb-4">
            <div>
                <h2 class="text-lg font-bold text-slate-900">Grafik Perkembangan Pendapatan per Tahun</h2>
                <p class="mt-0.5 text-xs text-slate-500">Visualisasi pendapatan komparatif antar tahun</p>
            </div>
        </div>

        <div class="mt-4 w-full">
            <x-charts.annual-revenue :annual-revenue="$annualRevenue" chart-height="h-80 sm:h-96" />
        </div>
    </div>
</x-layouts.app>

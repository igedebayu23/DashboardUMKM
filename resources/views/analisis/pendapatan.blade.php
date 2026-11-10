<x-layouts.app title="Grafik Pendapatan Tahunan">
    <form class="mb-6 flex flex-wrap items-end gap-3 rounded-xl bg-white p-5 shadow-sm">
        <div><label class="mb-1 block text-sm font-medium">Pilih UMKM</label><select name="umkm_id" class="rounded-lg border border-slate-300 px-3 py-2"><option value="">Semua UMKM</option>@foreach ($profiles as $profile)<option value="{{ $profile->umkm_id }}" @selected($selectedUmkm === $profile->umkm_id)>{{ $profile->nama_umkm }}</option>@endforeach</select></div>
        <button class="rounded-lg bg-amber-500 px-4 py-2 font-semibold">Tampilkan</button>
    </form>
    <div class="rounded-xl bg-white p-5 shadow-sm">
        <h2 class="text-lg font-semibold">Pendapatan per Tahun</h2>
        <div class="mt-6 overflow-x-auto rounded-xl bg-slate-50 p-4">
            @php($maxRevenue = max((float) $annualRevenue->max('total'), 1))
            @if ($annualRevenue->isNotEmpty())
                <div class="relative min-w-max">
                    <div class="pointer-events-none absolute inset-x-0 bottom-9 top-0 flex flex-col justify-between">
                        <span class="border-t border-dashed border-slate-200"></span>
                        <span class="border-t border-dashed border-slate-200"></span>
                        <span class="border-t border-dashed border-slate-200"></span>
                        <span class="border-t border-slate-300"></span>
                    </div>
                    <div class="relative flex items-end gap-5 border-b border-slate-300 px-4 pt-4">
                    @foreach ($annualRevenue as $row)
                        <div class="group flex w-24 flex-col items-center gap-2 text-center text-xs">
                            <span class="font-semibold text-slate-700 opacity-80 transition-opacity group-hover:opacity-100" title="Rp {{ number_format($row->total, 0, ',', '.') }}">Rp {{ number_format($row->total, 0, ',', '.') }}</span>
                            <div class="flex h-64 w-full items-end rounded-t-lg bg-slate-200/70">
                                <div class="relative w-full rounded-t-lg bg-gradient-to-t from-amber-600 via-amber-500 to-yellow-300 shadow-lg shadow-amber-500/20 transition-all duration-300 group-hover:scale-x-105 group-hover:from-orange-600 group-hover:to-amber-300" style="height: {{ min(100, ($row->total / $maxRevenue) * 100) }}%">
                                    <span class="absolute inset-x-1 top-1 h-1 rounded-full bg-white/40"></span>
                                </div>
                            </div>
                            <span class="font-semibold text-slate-600 transition-colors group-hover:text-amber-700">{{ $row->tahun }}</span>
                        </div>
                    @endforeach
                    </div>
                </div>
            @else
                <p class="text-slate-500">Tidak ada data laporan keuangan.</p>
            @endif
        </div>
    </div>
</x-layouts.app>

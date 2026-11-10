@props([
    'annualRevenue',
    'chartHeight' => 'h-72 sm:h-80 md:h-96',
])

@php
    $maxRevenue = (float) $annualRevenue->max('total');
    if ($maxRevenue <= 0) {
        $ceiling = 1000000;
    } else {
        $magnitude = pow(10, floor(log10($maxRevenue)));
        $normalized = $maxRevenue / $magnitude;
        if ($normalized <= 1.2) {
            $niceNorm = 1.2;
        } elseif ($normalized <= 2) {
            $niceNorm = 2;
        } elseif ($normalized <= 5) {
            $niceNorm = 5;
        } else {
            $niceNorm = 10;
        }
        $ceiling = max($niceNorm * $magnitude, $maxRevenue * 1.08);
    }

    $formatCurrency = function ($value) {
        if ($value >= 1_000_000_000) {
            return 'Rp ' . number_format($value / 1_000_000_000, 2, ',', '.') . ' M';
        }
        if ($value >= 1_000_000) {
            return 'Rp ' . number_format($value / 1_000_000, 1, ',', '.') . ' Jt';
        }
        if ($value >= 1_000) {
            return 'Rp ' . number_format($value / 1_000, 0, ',', '.') . ' Rb';
        }
        return 'Rp ' . number_format($value, 0, ',', '.');
    };

    $yTicks = [
        $ceiling,
        $ceiling * 0.75,
        $ceiling * 0.50,
        $ceiling * 0.25,
        0,
    ];
@endphp

<div class="w-full">
    @if ($annualRevenue->isNotEmpty())
        <div class="relative flex w-full gap-3 sm:gap-5 pt-8 pb-4">
            <!-- Y-Axis Labels -->
            <div class="flex flex-col justify-between text-right text-[11px] font-semibold text-slate-400 select-none pr-1 pb-10 {{ $chartHeight }} shrink-0">
                @foreach ($yTicks as $tick)
                    <span class="leading-none">{{ $formatCurrency($tick) }}</span>
                @endforeach
            </div>

            <!-- Plot Area: Fills remaining full width -->
            <div class="relative flex-1 flex flex-col justify-between {{ $chartHeight }}">
                <!-- Background Horizontal Gridlines -->
                <div class="pointer-events-none absolute inset-x-0 top-0 bottom-10 flex flex-col justify-between">
                    @foreach ($yTicks as $index => $tick)
                        <div class="w-full border-b {{ $index === count($yTicks) - 1 ? 'border-slate-300' : 'border-dashed border-slate-200' }}"></div>
                    @endforeach
                </div>

                <!-- Bars Container: Distributes evenly across 100% width -->
                <div class="relative flex-1 flex items-end justify-between gap-2 sm:gap-4 md:gap-6 z-10 pb-10">
                    @php $prevTotal = null; @endphp
                    @foreach ($annualRevenue as $row)
                        @php
                            $percentage = $ceiling > 0 ? ($row->total / $ceiling) * 100 : 0;
                            $barHeight = $row->total > 0 ? "min(100%, max(6px, {$percentage}%))" : "0%";
                            
                            $growth = null;
                            if ($prevTotal !== null && $prevTotal > 0) {
                                $growth = (($row->total - $prevTotal) / $prevTotal) * 100;
                            }
                            $prevTotal = $row->total;
                        @endphp

                        <div class="group relative flex-1 flex flex-col items-center h-full justify-end">
                            <!-- Floating Tooltip on Hover -->
                            <div class="pointer-events-none absolute -top-14 opacity-0 group-hover:opacity-100 transition-all duration-200 transform group-hover:-translate-y-1 z-30 flex flex-col items-center">
                                <div class="rounded-xl bg-slate-900 px-3.5 py-2 text-center shadow-xl ring-1 ring-white/10 whitespace-nowrap">
                                    <p class="text-[11px] font-medium text-amber-400">Tahun {{ $row->tahun }}</p>
                                    <p class="text-sm font-bold text-white tracking-wide">Rp {{ number_format($row->total, 0, ',', '.') }}</p>
                                    @if ($growth !== null)
                                        <p class="text-[11px] font-semibold mt-0.5 {{ $growth >= 0 ? 'text-emerald-400' : 'text-rose-400' }}">
                                            {{ $growth >= 0 ? '▲ +' : '▼ ' }}{{ number_format(abs($growth), 1, ',', '.') }}% vs tahun sebelumnya
                                        </p>
                                    @endif
                                </div>
                                <div class="w-2.5 h-2.5 bg-slate-900 rotate-45 -mt-1"></div>
                            </div>

                            <!-- Value Label Above Bar -->
                            <div class="mb-2 text-center transition-all duration-200 group-hover:-translate-y-0.5">
                                <span class="hidden md:inline-block text-[11px] font-bold text-slate-700 bg-white/90 backdrop-blur-sm px-2 py-0.5 rounded-md shadow-xs border border-slate-200/80">
                                    {{ $formatCurrency($row->total) }}
                                </span>
                                <span class="md:hidden text-[10px] font-bold text-slate-700">
                                    {{ $formatCurrency($row->total) }}
                                </span>
                            </div>

                            <!-- The Bar Itself (Responsive max width with full centering) -->
                            <div class="relative w-full max-w-[48px] sm:max-w-[64px] md:max-w-[84px] lg:max-w-[100px] flex items-end justify-center h-full">
                                <div class="w-full flex items-end justify-center h-full rounded-t-xl overflow-hidden bg-slate-100/40">
                                    <div class="w-full rounded-t-xl bg-gradient-to-t from-amber-600 via-amber-500 to-amber-400 shadow-md shadow-amber-500/20 transition-all duration-300 group-hover:from-amber-500 group-hover:via-amber-400 group-hover:to-yellow-300 group-hover:shadow-amber-500/40 group-hover:shadow-lg relative overflow-hidden"
                                         style="height: {{ $barHeight }};">
                                        <!-- Top gloss highlight -->
                                        <div class="absolute inset-x-0 top-0 h-1 bg-white/40 rounded-t-xl"></div>
                                    </div>
                                </div>
                            </div>

                            <!-- X-Axis Label (Year + Growth) -->
                            <div class="absolute -bottom-9 flex flex-col items-center">
                                <span class="text-xs sm:text-sm font-bold text-slate-700 transition-colors group-hover:text-amber-600">
                                    {{ $row->tahun }}
                                </span>
                                @if ($growth !== null)
                                    <span class="hidden sm:inline-block text-[10px] font-semibold {{ $growth >= 0 ? 'text-emerald-600' : 'text-rose-600' }}">
                                        {{ $growth >= 0 ? '+' : '' }}{{ number_format($growth, 1) }}%
                                    </span>
                                @else
                                    <span class="hidden sm:inline-block text-[10px] font-semibold text-slate-400">
                                        Awal
                                    </span>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Legend & Interactive Hint Footer -->
        <div class="mt-8 flex flex-wrap items-center justify-between border-t border-slate-100 pt-4 text-xs text-slate-500 gap-2">
            <div class="flex items-center gap-2">
                <span class="inline-block h-3 w-3 rounded-md bg-gradient-to-tr from-amber-600 to-amber-400 shadow-xs"></span>
                <span class="font-medium text-slate-600">Total Pendapatan UMKM</span>
            </div>
            <div class="flex items-center gap-2 text-slate-400">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <span>Arahkan kursor pada batang grafik untuk melihat nominal detail & persentase perubahan</span>
            </div>
        </div>
    @else
        <div class="flex flex-col items-center justify-center py-16 text-center text-slate-400">
            <div class="rounded-full bg-slate-100 p-4 mb-3">
                <svg class="h-8 w-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                </svg>
            </div>
            <p class="font-semibold text-slate-600">Belum ada data pendapatan</p>
            <p class="text-xs text-slate-400 mt-1 max-w-sm">Data grafik akan terisi secara otomatis berdasarkan laporan keuangan UMKM yang terdaftar.</p>
        </div>
    @endif
</div>

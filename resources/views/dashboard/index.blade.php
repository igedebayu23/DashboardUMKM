<x-layouts.app title="Dashboard">
    <div class="mb-6">
        <p class="text-sm text-slate-500">Selamat datang kembali, {{ auth()->user()->name }}.</p>
        <h2 class="mt-1 text-2xl font-bold text-slate-900">Ringkasan UMKM</h2>
    </div>
    <div class="grid gap-5 md:grid-cols-3">
        <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
            <div class="flex items-start justify-between"><div><p class="text-sm font-medium text-slate-500">Jumlah UMKM Binaan</p><p class="mt-3 text-3xl font-bold text-slate-900">{{ $umkmCount }}</p></div><div class="rounded-lg bg-amber-100 p-3 text-amber-600"><svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 21h18M5 21V7l7-4 7 4v14M9 21v-7h6v7"/></svg></div></div>
            <p class="mt-4 text-xs text-slate-500">Total UMKM yang terdaftar</p>
        </div>
        <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
            <div class="flex items-start justify-between"><div><p class="text-sm font-medium text-slate-500">Total Pendapatan {{ $latestYear ?? 'Terbaru' }}</p><p class="mt-3 text-2xl font-bold text-slate-900">Rp {{ number_format($latestRevenue, 0, ',', '.') }}</p></div><div class="rounded-lg bg-emerald-100 p-3 text-emerald-600"><svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 3v18m5-14.5c0-1.38-2.24-2.5-5-2.5S7 5.12 7 6.5 9.24 9 12 9s5 1.12 5 2.5S14.76 14 12 14s-5 1.12-5 2.5S9.24 19 12 19s5-1.12 5-2.5"/></svg></div></div>
            <p class="mt-4 text-xs text-slate-500">{{ $latestYear === null ? 'Belum ada laporan keuangan' : 'Akumulasi seluruh laporan tahunan' }}</p>
        </div>
        <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
            <div class="flex items-start justify-between"><div><p class="text-sm font-medium text-slate-500">UMKM Mengalami Penurunan</p><p class="mt-3 text-3xl font-bold text-slate-900">{{ $decliningCount }}</p></div><div class="rounded-lg bg-red-100 p-3 text-red-600"><svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="m5 5 4 4m0-4-4 4m8 6h6m-6 4h4"/></svg></div></div>
            <p class="mt-4 text-xs text-slate-500">Berdasarkan perbandingan tahun terakhir</p>
        </div>
    </div>
    <div class="mt-6 rounded-2xl border border-slate-200/80 bg-white p-6 shadow-xs">
        <div class="flex flex-wrap items-center justify-between gap-3 border-b border-slate-100 pb-4">
            <div>
                <h2 class="text-lg font-bold text-slate-900">Total Pendapatan per Tahun</h2>
                <p class="mt-0.5 text-xs text-slate-500">Jumlah pendapatan seluruh UMKM binaan berdasarkan tahun.</p>
            </div>
            <a href="{{ route('analisis.pendapatan') }}" class="inline-flex items-center gap-1.5 rounded-xl border border-slate-200/80 bg-slate-50 px-3.5 py-1.5 text-xs font-semibold text-amber-700 transition hover:bg-amber-50 hover:border-amber-200">
                Lihat detail grafik
                <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </a>
        </div>
        <div class="mt-4 w-full">
            <x-charts.annual-revenue :annual-revenue="$annualRevenue" chart-height="h-72 sm:h-80 md:h-88" />
        </div>
    </div>
</x-layouts.app>

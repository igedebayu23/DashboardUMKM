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
    <div class="mt-6 rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
        <div class="flex items-center justify-between"><div><h2 class="text-lg font-semibold">Total Pendapatan per Tahun</h2><p class="mt-1 text-sm text-slate-500">Jumlah pendapatan seluruh UMKM berdasarkan tahun.</p></div><a href="{{ route('analisis.pendapatan') }}" class="text-sm font-medium text-amber-600 hover:text-amber-700">Lihat detail →</a></div>
        <div class="mt-7 space-y-5">
            @php($maxRevenue = max((float) $annualRevenue->max('total'), 1))
            @forelse ($annualRevenue as $row)
                <div class="grid grid-cols-[4rem_1fr_auto] items-center gap-3 text-sm"><span class="font-medium text-slate-600">{{ $row->tahun }}</span><div class="h-6 rounded-md bg-slate-100"><div class="h-6 rounded-md bg-amber-500 transition-all" style="width: {{ min(100, ($row->total / $maxRevenue) * 100) }}%"></div></div><span class="font-medium text-slate-700">Rp {{ number_format($row->total, 0, ',', '.') }}</span></div>
            @empty
                <p class="text-slate-500">Belum ada data pendapatan.</p>
            @endforelse
        </div>
    </div>
</x-layouts.app>

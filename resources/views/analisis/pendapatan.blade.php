<x-layouts.app title="Grafik Pendapatan Tahunan">
    <form class="mb-6 flex flex-wrap items-end gap-3 rounded-xl bg-white p-5 shadow-sm">
        <div><label class="mb-1 block text-sm font-medium">Pilih UMKM</label><select name="umkm_id" class="rounded-lg border border-slate-300 px-3 py-2"><option value="">Semua UMKM</option>@foreach ($profiles as $profile)<option value="{{ $profile->umkm_id }}" @selected($selectedUmkm === $profile->umkm_id)>{{ $profile->nama_umkm }}</option>@endforeach</select></div>
        <button class="rounded-lg bg-amber-500 px-4 py-2 font-semibold">Tampilkan</button>
    </form>
    <div class="rounded-xl bg-white p-5 shadow-sm">
        <h2 class="text-lg font-semibold">Pendapatan per Tahun</h2>
        <div class="mt-6 space-y-4">
            @php($maxRevenue = max((float) $annualRevenue->max('total'), 1))
            @forelse ($annualRevenue as $row)
                <div class="grid grid-cols-[4rem_1fr_auto] items-center gap-3 text-sm"><span class="font-medium">{{ $row->tahun }}</span><div class="h-7 rounded bg-slate-100"><div class="h-7 rounded bg-amber-500" style="width: {{ min(100, ($row->total / $maxRevenue) * 100) }}%"></div></div><span>Rp {{ number_format($row->total, 0, ',', '.') }}</span></div>
            @empty
                <p class="text-slate-500">Tidak ada data laporan keuangan.</p>
            @endforelse
        </div>
    </div>
</x-layouts.app>

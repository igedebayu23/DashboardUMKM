<x-layouts.app title="{{ $report->exists ? 'Edit Laporan Keuangan' : 'Tambah Laporan Keuangan' }}">
    @php
        $cancelRoute = auth()->user()->isPesertaMagang()
            ? route('profile-umkm.create')
            : route('laporan-keuangan.index');
    @endphp
    <form method="POST" action="{{ $report->exists ? route('laporan-keuangan.update', $report) : route('laporan-keuangan.store') }}" class="max-w-2xl rounded-xl bg-white p-6 shadow-sm">
        @csrf @if ($report->exists) @method('PUT') @endif
        <div class="space-y-5">
            <div><label class="mb-1 block text-sm font-medium">Nama UMKM</label><select name="umkm_id" required class="w-full rounded-lg border border-slate-300 px-3 py-2.5"><option value="">Pilih UMKM</option>@foreach ($profiles as $profile)<option value="{{ $profile->umkm_id }}" @selected(old('umkm_id', $report->umkm_id) == $profile->umkm_id)>{{ $profile->nama_umkm }}</option>@endforeach</select></div>
            <div class="grid gap-5 md:grid-cols-2"><div><label class="mb-1 block text-sm font-medium">Tahun</label><input name="tahun" type="number" min="2021" value="{{ old('tahun', $report->tahun ?? date('Y')) }}" required class="w-full rounded-lg border border-slate-300 px-3 py-2.5"></div><div><label class="mb-1 block text-sm font-medium">Bulan</label><select name="bulan" required class="w-full rounded-lg border border-slate-300 px-3 py-2.5">@foreach (['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'] as $month)<option @selected(old('bulan', $report->bulan) === $month)>{{ $month }}</option>@endforeach</select></div></div>
            <div><label class="mb-1 block text-sm font-medium">Pendapatan</label><input name="pendapatan" type="number" min="0" step="0.01" value="{{ old('pendapatan', $report->pendapatan) }}" required class="w-full rounded-lg border border-slate-300 px-3 py-2.5"></div>
        </div>
        <div class="mt-6 flex gap-3"><a href="{{ auth()->user()->isPesertaMagang() ? route('profile-umkm.create') : route('laporan-keuangan.index') }}" class="rounded-lg border px-4 py-2">Batal</a><button class="rounded-lg bg-amber-500 px-4 py-2 font-semibold">Simpan</button></div>
    </form>
</x-layouts.app>

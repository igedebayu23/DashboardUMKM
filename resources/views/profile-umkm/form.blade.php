<x-layouts.app title="{{ $profile->exists ? 'Edit Profile UMKM' : 'Tambah Profile UMKM' }}">
    <form method="POST" action="{{ $profile->exists ? route('profile-umkm.update', $profile) : route('profile-umkm.store') }}" class="max-w-3xl rounded-xl bg-white p-6 shadow-sm">
        @csrf @if ($profile->exists) @method('PUT') @endif
        <div class="grid gap-5 md:grid-cols-2">
            @foreach ([['nama_umkm','Nama UMKM'],['sektor','Sektor'],['nama_pemilik','Nama Pemilik'],['lokasi','Lokasi'],['no_hp','Nomor HP'],['jumlah_karyawan','Jumlah Karyawan']] as [$name,$label])
                <div><label for="{{ $name }}" class="mb-1 block text-sm font-medium">{{ $label }}</label><input id="{{ $name }}" name="{{ $name }}" value="{{ old($name, $profile->{$name}) }}" type="{{ $name === 'jumlah_karyawan' ? 'number' : 'text' }}" required class="w-full rounded-lg border border-slate-300 px-3 py-2.5"></div>
            @endforeach
        </div>
        <div class="mt-6 flex gap-3"><a href="{{ auth()->user()->isPesertaMagang() ? route('laporan-keuangan.create') : route('profile-umkm.index') }}" class="rounded-lg border px-4 py-2">Batal</a><button class="rounded-lg bg-amber-500 px-4 py-2 font-semibold">Simpan</button></div>
    </form>
</x-layouts.app>

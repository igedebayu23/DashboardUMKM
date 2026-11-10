<x-layouts.app title="Profile UMKM">
    <div class="mb-5 flex flex-wrap items-center justify-between gap-3">
        <form class="flex gap-2"><input name="search" value="{{ request('search') }}" placeholder="Cari UMKM..." class="rounded-lg border border-slate-300 px-3 py-2"><button class="rounded-lg bg-slate-800 px-4 py-2 text-white">Cari</button></form>
        @if (auth()->user()->isPegawai())
            <a href="{{ route('profile-umkm.create') }}" class="rounded-lg bg-amber-500 px-4 py-2 font-semibold text-slate-950">Tambah Profile</a>
        @endif
    </div>
    <div class="overflow-x-auto rounded-xl bg-white shadow-sm">
        <table class="w-full text-left text-sm"><thead class="bg-slate-50 text-slate-600"><tr><th class="p-4">Nama UMKM</th><th class="p-4">Sektor</th><th class="p-4">Pemilik</th><th class="p-4">Lokasi</th><th class="p-4">Karyawan</th><th class="p-4">Aksi</th></tr></thead><tbody class="divide-y">
        @forelse ($profiles as $profile)
            <tr><td class="p-4 font-medium">{{ $profile->nama_umkm }}</td><td class="p-4">{{ $profile->sektor }}</td><td class="p-4">{{ $profile->nama_pemilik }}</td><td class="p-4">{{ $profile->lokasi }}</td><td class="p-4">{{ $profile->jumlah_karyawan }}</td><td class="p-4"><div class="flex gap-2">@if (auth()->user()->isPegawai())<a href="{{ route('profile-umkm.edit', $profile) }}" class="text-blue-600">Edit</a><form method="POST" action="{{ route('profile-umkm.destroy', $profile) }}">@csrf @method('DELETE')<button class="text-red-600" onclick="return confirm('Hapus profile ini?')">Hapus</button></form>@endif</div></td></tr>
        @empty
            <tr><td colspan="6" class="p-8 text-center text-slate-500">Belum ada data profile UMKM.</td></tr>
        @endforelse
        </tbody></table>
    </div>
    <div class="mt-5">{{ $profiles->links() }}</div>
</x-layouts.app>

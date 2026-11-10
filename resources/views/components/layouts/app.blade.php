@props(['title' => 'Dashboard UMKM'])
@php
    $canView = auth()->user()->isPegawai() || auth()->user()->isPimpinan();
    $canCreate = auth()->user()->isPegawai() || auth()->user()->isPesertaMagang();
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }} - Sistem Informasi Pemantauan UMKM</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-slate-950 text-slate-100 antialiased">
    <div class="min-h-screen lg:flex">
        <aside class="border-b border-slate-800 bg-slate-950 lg:fixed lg:inset-y-0 lg:flex lg:w-72 lg:flex-col lg:border-b-0 lg:border-r">
            <div class="flex h-20 items-center border-b border-slate-800 px-6">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3">
                    <img src="{{ asset('images/logo.png') }}" alt="Bank Indonesia" class="h-10 w-10">
                    <span class="text-sm font-bold leading-tight">Sistem Informasi<br><span class="text-amber-400">Pemantauan UMKM</span></span>
                </a>
            </div>
            <nav class="flex gap-2 overflow-x-auto p-4 lg:block lg:flex-1 lg:space-y-7 lg:overflow-y-auto">
                <div>
                    <p class="mb-2 hidden px-3 text-xs font-semibold uppercase tracking-wider text-slate-500 lg:block">Dashboard</p>
                    @if ($canView)
                        <a href="{{ route('dashboard') }}" class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium {{ request()->routeIs('dashboard') ? 'bg-amber-500 text-slate-950 shadow-lg shadow-amber-500/10' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                            <svg class="h-5 w-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 13h8V3H3v10Zm10 8h8V3h-8v18ZM3 21h8v-6H3v6Z"/></svg>
                            Dashboard
                        </a>
                    @endif
                </div>
                @if ($canView)
                    <div>
                        <p class="mb-2 hidden px-3 text-xs font-semibold uppercase tracking-wider text-slate-500 lg:block">View</p>
                        <div class="space-y-1">
                            <a href="{{ route('laporan-keuangan.index') }}" class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium {{ request()->routeIs('laporan-keuangan.index') ? 'bg-amber-500 text-slate-950' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                                <svg class="h-5 w-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M7 3h10a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2Zm3 5h6m-6 4h6m-6 4h4"/></svg>
                                Laporan Keuangan UMKM
                            </a>
                            <a href="{{ route('profile-umkm.index') }}" class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium {{ request()->routeIs('profile-umkm.index') ? 'bg-amber-500 text-slate-950' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                                <svg class="h-5 w-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 20a8 8 0 0 1 16 0M12 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8Z"/></svg>
                                Profile UMKM
                            </a>
                        </div>
                    </div>
                    <div>
                        <p class="mb-2 hidden px-3 text-xs font-semibold uppercase tracking-wider text-slate-500 lg:block">Analisis</p>
                        <div class="space-y-1">
                            <a href="{{ route('analisis.pendapatan') }}" class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium {{ request()->routeIs('analisis.pendapatan') ? 'bg-amber-500 text-slate-950' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                                <svg class="h-5 w-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 19V5m0 14h16M8 16v-3m4 3V8m4 8v-6"/></svg>
                                Grafik Pendapatan Tahunan
                            </a>
                            <a href="{{ route('analisis.penurunan') }}" class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium {{ request()->routeIs('analisis.penurunan') ? 'bg-amber-500 text-slate-950' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                                <svg class="h-5 w-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="m5 5 4 4m0-4-4 4m8 6h6m-6 4h4"/></svg>
                                Penurunan Pendapatan
                            </a>
                        </div>
                    </div>
                @endif
                @if ($canCreate)
                    <div>
                        <p class="mb-2 hidden px-3 text-xs font-semibold uppercase tracking-wider text-slate-500 lg:block">Create</p>
                        <div class="space-y-1">
                            <a href="{{ route('laporan-keuangan.create') }}" class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium text-slate-300 hover:bg-slate-800 hover:text-white"><span class="text-lg leading-none text-amber-400">+</span> Tambah Laporan Keuangan</a>
                            <a href="{{ route('profile-umkm.create') }}" class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium text-slate-300 hover:bg-slate-800 hover:text-white"><span class="text-lg leading-none text-amber-400">+</span> Tambah Profile UMKM</a>
                        </div>
                    </div>
                @endif
            </nav>
            <div class="hidden border-t border-slate-800 p-4 lg:block">
                <div class="flex items-center gap-3 rounded-lg bg-slate-900 p-3">
                    <div class="flex h-9 w-9 items-center justify-center rounded-full bg-amber-500 font-bold text-slate-950">{{ auth()->user()->initials() }}</div>
                    <div class="min-w-0"><p class="truncate text-sm font-semibold">{{ auth()->user()->name }}</p><p class="text-xs capitalize text-slate-500">{{ str_replace('_', ' ', auth()->user()->role) }}</p></div>
                </div>
            </div>
        </aside>
        <main class="min-w-0 flex-1 lg:ml-72">
            <header class="flex min-h-20 items-center justify-between border-b border-slate-200 bg-white px-5 py-4 text-slate-900 shadow-sm lg:px-8">
                <div><p class="text-xs font-semibold uppercase tracking-wider text-slate-500">Bank Indonesia</p><h1 class="mt-1 text-xl font-bold">{{ $title }}</h1></div>
                <div class="flex items-center gap-3">
                    <span class="hidden text-sm text-slate-600 sm:block">{{ auth()->user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}">@csrf<button title="Keluar" class="rounded-lg border border-slate-200 p-2 text-slate-500 hover:bg-slate-50 hover:text-red-600"><svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 17l5-5-5-5m5 5H9m3 7H6a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2h6"/></svg></button></form>
                </div>
            </header>
            <section class="min-h-[calc(100vh-5rem)] bg-slate-50 p-5 text-slate-900 lg:p-8">
                @if (session('success'))<div class="mb-6 flex items-center gap-3 rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800"><span class="text-lg">✓</span>{{ session('success') }}</div>@endif
                @if ($errors->any())<div class="mb-6 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800"><ul class="list-inside list-disc">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif
                {{ $slot }}
            </section>
        </main>
    </div>
    <dialog id="delete-confirmation" class="m-0 w-[calc(100%-2rem)] max-w-sm rounded-xl border-0 bg-transparent p-0 shadow-2xl backdrop:bg-slate-950/60" style="position: fixed; inset: 50% auto auto 50%; transform: translate(-50%, -50%);">
        <div class="rounded-xl bg-white p-5 text-slate-900">
            <div class="mx-auto flex h-9 w-9 items-center justify-center rounded-full bg-red-100 text-red-600">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 4h.01M5.07 19h13.86c1.54 0 2.5-1.67 1.73-3L13.73 4c-.77-1.33-2.69-1.33-3.46 0L3.34 16c-.77 1.33.19 3 1.73 3Z"/></svg>
            </div>
            <h2 class="mt-3 text-center text-base font-bold">Konfirmasi penghapusan</h2>
            <p id="delete-confirmation-message" class="mt-1.5 text-center text-sm leading-5 text-slate-600">Data yang dihapus tidak dapat dikembalikan.</p>
            <div class="mt-5 flex justify-center gap-4">
                <button type="button" id="delete-cancel" class="rounded-lg border border-slate-300 px-3.5 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-50">Batal</button>
                <button type="button" id="delete-confirm" class="rounded-lg px-3.5 py-2 text-sm font-semibold text-white" style="background-color: #dc2626;" onmouseenter="this.style.backgroundColor='#b91c1c'" onmouseleave="this.style.backgroundColor='#dc2626'">Hapus</button>
            </div>
        </div>
    </dialog>
    <script>
        (() => {
            const dialog = document.getElementById('delete-confirmation');
            const message = document.getElementById('delete-confirmation-message');
            const cancelButton = document.getElementById('delete-cancel');
            const confirmButton = document.getElementById('delete-confirm');
            let formToDelete = null;

            document.querySelectorAll('[data-confirm-delete]').forEach((button) => {
                button.addEventListener('click', (event) => {
                    event.preventDefault();
                    formToDelete = button.closest('form');
                    message.textContent = button.dataset.confirmMessage || 'Data yang dihapus tidak dapat dikembalikan.';
                    dialog.showModal();
                });
            });

            cancelButton.addEventListener('click', () => dialog.close());
            dialog.addEventListener('close', () => { formToDelete = null; });
            confirmButton.addEventListener('click', () => {
                if (formToDelete) formToDelete.submit();
            });
        })();
    </script>
</body>
</html>

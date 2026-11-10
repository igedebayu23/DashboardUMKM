<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign in - Sistem Informasi Pemantauan UMKM</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="flex min-h-screen items-center justify-center bg-gradient-to-br from-[#05080f] via-[#0a1020] to-[#0d1730] p-5">
    <main class="w-full max-w-xl rounded-2xl border border-white/10 bg-slate-900/95 p-7 shadow-2xl shadow-black/50 backdrop-blur-md sm:p-10">
        <header class="flex flex-col items-center text-center">
            <img src="{{ asset('images/BI_Logo.png') }}" alt="Bank Indonesia" class="h-24 max-w-full object-contain sm:h-28">
            <h1 class="mt-4 text-2xl font-bold text-white">Sistem Informasi Pemantauan UMKM</h1>
            <p class="mt-4 w-full border-t border-white/15 pt-4 text-xl font-bold text-white">Sign in</p>
        </header>
        <form method="POST" action="{{ route('login.store') }}" class="mt-8 space-y-5">
            @csrf
            <div><label for="email" class="mb-2 block text-sm font-medium text-white">Email/Username</label><input id="email" name="email" type="email" value="{{ old('email') }}" placeholder="Enter your email/username" required autofocus autocomplete="username" class="min-h-13 w-full rounded-[0.6rem] border border-white/10 bg-slate-800/90 px-4 py-3 text-white outline-none placeholder:text-white/35 focus:border-amber-500 focus:ring-2 focus:ring-amber-500/30">@error('email')<p class="mt-1 text-sm text-red-300">{{ $message }}</p>@enderror</div>
            <div>
                <label for="password" class="mb-2 block text-sm font-medium text-white">Password</label>
                <div class="relative">
                    <input id="password" name="password" type="password" placeholder="Enter your password" required autocomplete="current-password" class="min-h-13 w-full rounded-[0.6rem] border border-white/10 bg-slate-800/90 px-4 py-3 pr-12 text-white outline-none placeholder:text-white/35 focus:border-amber-500 focus:ring-2 focus:ring-amber-500/30">
                    <button type="button" data-password-toggle data-password-target="password" aria-label="Show password" class="absolute inset-y-0 right-0 flex w-12 items-center justify-center text-white/60 transition hover:text-white focus:text-white focus:outline-none focus:ring-2 focus:ring-inset focus:ring-amber-500" title="Show password">
                        <svg data-password-icon="show" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="pointer-events-none absolute size-5 scale-75 rotate-12 opacity-0 transition-all duration-200 ease-out" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.644C3.423 7.51 7.36 4.5 12 4.5c4.64 0 8.577 3.01 9.964 7.178.07.209.07.437 0 .646C20.577 16.49 16.64 19.5 12 19.5c-4.64 0-8.577-3.01-9.964-7.178Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        </svg>
                        <svg data-password-icon="hide" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="pointer-events-none absolute size-5 scale-100 rotate-0 opacity-100 transition-all duration-200 ease-out" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 2.036 12.322a1.012 1.012 0 0 0 0 .644C3.423 17.49 7.36 20.5 12 20.5c1.915 0 3.684-.552 5.184-1.504M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.64 0 8.577 3.01 9.964 7.178.07.209.07.437 0 .646a10.478 10.478 0 0 1-1.453 2.627M6.228 6.228 3 3m3.228 3.228 3.07 3.07m5.404 5.404 3.07 3.07M9.3 9.3a3 3 0 0 0 4.243 4.243M9.3 9.3 3 3m5.303 5.303 4.243 4.243m0 0 3.07 3.07M14.7 14.7 21 21" />
                        </svg>
                    </button>
                </div>
                @error('password')<p class="mt-1 text-sm text-red-300">{{ $message }}</p>@enderror
            </div>
            <button type="submit" class="min-h-13 w-full rounded-[0.6rem] bg-[#ff8a00] px-4 py-3 text-base font-bold text-[#1a0e00] hover:bg-[#ff9d2e]">Sign in</button>
        </form>
    </main>
</body>
</html>

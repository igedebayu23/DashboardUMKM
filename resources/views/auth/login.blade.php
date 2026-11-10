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
            <div><label for="password" class="mb-2 block text-sm font-medium text-white">Password</label><input id="password" name="password" type="password" placeholder="Enter your password" required autocomplete="current-password" class="min-h-13 w-full rounded-[0.6rem] border border-white/10 bg-slate-800/90 px-4 py-3 text-white outline-none placeholder:text-white/35 focus:border-amber-500 focus:ring-2 focus:ring-amber-500/30">@error('password')<p class="mt-1 text-sm text-red-300">{{ $message }}</p>@enderror</div>
            <button type="submit" class="min-h-13 w-full rounded-[0.6rem] bg-[#ff8a00] px-4 py-3 text-base font-bold text-[#1a0e00] hover:bg-[#ff9d2e]">Sign in</button>
        </form>
    </main>
</body>
</html>

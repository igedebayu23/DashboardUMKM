<?php

use App\Http\Controllers\AnalisisController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LaporanKeuanganUmkmController;
use App\Http\Controllers\ProfileUmkmController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/login')->name('home');

Route::middleware('guest')->group(function (): void {
    Route::get('/login', [AuthController::class, 'create'])->name('login');
    Route::post('/login', [AuthController::class, 'store'])->name('login.store');
});

Route::middleware('auth')->group(function (): void {
    Route::post('/logout', [AuthController::class, 'destroy'])->name('logout');

    Route::middleware('role:admin,pimpinan')->group(function (): void {
        Route::get('/dashboard', DashboardController::class)->name('dashboard');
        Route::resource('profile-umkm', ProfileUmkmController::class)
            ->only(['index']);
        Route::get('/laporan-keuangan', [LaporanKeuanganUmkmController::class, 'index'])
            ->name('laporan-keuangan.index');
        Route::get('/analisis/pendapatan', [AnalisisController::class, 'annualRevenue'])
            ->name('analisis.pendapatan');
        Route::get('/analisis/penurunan', [AnalisisController::class, 'declining'])
            ->name('analisis.penurunan');
    });

    Route::middleware('role:admin,peserta_magang')->group(function (): void {
        Route::get('/profile-umkm/create', [ProfileUmkmController::class, 'create'])
            ->name('profile-umkm.create');
        Route::post('/profile-umkm', [ProfileUmkmController::class, 'store'])
            ->name('profile-umkm.store');
        Route::get('/laporan-keuangan/create', [LaporanKeuanganUmkmController::class, 'create'])
            ->name('laporan-keuangan.create');
        Route::post('/laporan-keuangan', [LaporanKeuanganUmkmController::class, 'store'])
            ->name('laporan-keuangan.store');
    });

    Route::middleware('role:admin')->group(function (): void {
        Route::get('/profile-umkm/{profile_umkm}/edit', [ProfileUmkmController::class, 'edit'])
            ->name('profile-umkm.edit');
        Route::put('/profile-umkm/{profile_umkm}', [ProfileUmkmController::class, 'update'])
            ->name('profile-umkm.update');
        Route::delete('/profile-umkm/{profile_umkm}', [ProfileUmkmController::class, 'destroy'])
            ->name('profile-umkm.destroy');
        Route::get('/laporan-keuangan/{laporan_keuangan}/edit', [LaporanKeuanganUmkmController::class, 'edit'])
            ->name('laporan-keuangan.edit');
        Route::put('/laporan-keuangan/{laporan_keuangan}', [LaporanKeuanganUmkmController::class, 'update'])
            ->name('laporan-keuangan.update');
        Route::delete('/laporan-keuangan/{laporan_keuangan}', [LaporanKeuanganUmkmController::class, 'destroy'])
            ->name('laporan-keuangan.destroy');
    });
});

<?php

namespace App\Providers\Filament;

use App\Filament\Pages\Auth\Login as AuthLogin;
use App\Filament\Pages\Dashboard;
use App\Filament\Pages\GrafikPendapatanTahunan;
use App\Filament\Pages\PenurunanUmkm;
use App\Filament\Resources\LaporanKeuanganUmkms\LaporanKeuanganUmkmResource;
use App\Filament\Resources\ProfileUmkms\ProfileUmkmResource;
use App\Filament\Widgets\DashboardStatsOverview;
use App\Filament\Widgets\PendapatanTahunanChart;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\NavigationItem;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\View\PanelsRenderHook;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\PreventRequestForgery;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login(AuthLogin::class)
            ->brandName('Bank Indonesia')
            ->brandLogo(asset('images/BI_Logo.png'))
            ->brandLogoHeight('3.5rem')
            ->colors([
                'primary' => Color::Amber,
            ])
            ->navigationItems([
                NavigationItem::make('Laporan Keuangan UMKM')
                    ->group('View')
                    ->url(fn (): string => LaporanKeuanganUmkmResource::getUrl('index'))
                    ->visible(fn (): bool => (bool) (auth()->user()?->isAdmin() || auth()->user()?->isPimpinan())),
                NavigationItem::make('Profile UMKM')
                    ->group('View')
                    ->url(fn (): string => ProfileUmkmResource::getUrl('index'))
                    ->visible(fn (): bool => (bool) (auth()->user()?->isAdmin() || auth()->user()?->isPimpinan())),
                NavigationItem::make('Tambah Laporan Keuangan UMKM')
                    ->group('Create')
                    ->url(fn (): string => LaporanKeuanganUmkmResource::getUrl('create'))
                    ->visible(fn (): bool => (bool) (auth()->user()?->isAdmin() || auth()->user()?->isPesertaMagang())),
                NavigationItem::make('Tambah Profile UMKM')
                    ->group('Create')
                    ->url(fn (): string => ProfileUmkmResource::getUrl('create'))
                    ->visible(fn (): bool => (bool) (auth()->user()?->isAdmin() || auth()->user()?->isPesertaMagang())),
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\Filament\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\Filament\Pages')
            ->pages([
                Dashboard::class,
                GrafikPendapatanTahunan::class,
                PenurunanUmkm::class,
            ])
            ->widgets([
                DashboardStatsOverview::class,
                PendapatanTahunanChart::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                PreventRequestForgery::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ])
            ->renderHook(
                PanelsRenderHook::STYLES_AFTER,
                fn () => view('filament.pages.login-styles'),
            );
    }
}

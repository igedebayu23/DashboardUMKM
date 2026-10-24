<?php

namespace App\Providers;

use App\Auth\LoginResponse;
use App\Models\LaporanKeuanganUmkm;
use App\Models\ProfileUmkm;
use App\Policies\LaporanKeuanganUmkmPolicy;
use App\Policies\ProfileUmkmPolicy;
use Carbon\CarbonImmutable;
use Filament\Auth\Http\Responses\Contracts\LoginResponse as LoginResponseContract;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(
            LoginResponseContract::class,
            LoginResponse::class,
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->configureDefaults();

        Gate::policy(LaporanKeuanganUmkm::class, LaporanKeuanganUmkmPolicy::class);
        Gate::policy(ProfileUmkm::class, ProfileUmkmPolicy::class);
    }

    /**
     * Configure default behaviors for production-ready applications.
     */
    protected function configureDefaults(): void
    {
        Date::use(CarbonImmutable::class);

        DB::prohibitDestructiveCommands(
            app()->isProduction(),
        );

        Password::defaults(fn (): ?Password => app()->isProduction()
            ? Password::min(12)
                ->mixedCase()
                ->letters()
                ->numbers()
                ->symbols()
                ->uncompromised()
            : null,
        );
    }
}

<?php

namespace App\Auth;

use App\Filament\Resources\LaporanKeuanganUmkms\LaporanKeuanganUmkmResource;
use Filament\Auth\Http\Responses\Contracts\LoginResponse as LoginResponseContract;
use Filament\Facades\Filament;
use Illuminate\Http\RedirectResponse;
use Livewire\Features\SupportRedirects\Redirector;

class LoginResponse implements LoginResponseContract
{
    public function toResponse($request): RedirectResponse|Redirector
    {
        $user = auth()->user();

        if ($user?->isPesertaMagang()) {
            return redirect()->to(LaporanKeuanganUmkmResource::getUrl('create'));
        }

        return redirect()->intended(Filament::getUrl());
    }
}

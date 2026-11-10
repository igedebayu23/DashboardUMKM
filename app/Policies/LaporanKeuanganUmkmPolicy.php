<?php

namespace App\Policies;

use App\Models\LaporanKeuanganUmkm;
use App\Models\User;

class LaporanKeuanganUmkmPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(?User $user): bool
    {
        return (bool) ($user?->isPegawai() || $user?->isPimpinan());
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(?User $user, LaporanKeuanganUmkm $record): bool
    {
        return (bool) ($user?->isPegawai() || $user?->isPimpinan());
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(?User $user): bool
    {
        return (bool) ($user?->isPegawai() || $user?->isPesertaMagang());
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(?User $user, LaporanKeuanganUmkm $record): bool
    {
        return (bool) $user?->isPegawai();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(?User $user, LaporanKeuanganUmkm $record): bool
    {
        return (bool) $user?->isPegawai();
    }
}

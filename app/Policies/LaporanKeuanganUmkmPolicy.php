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
        return (bool) ($user?->isAdmin() || $user?->isPimpinan());
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(?User $user, LaporanKeuanganUmkm $record): bool
    {
        return (bool) ($user?->isAdmin() || $user?->isPimpinan());
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(?User $user): bool
    {
        return (bool) ($user?->isAdmin() || $user?->isPesertaMagang());
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(?User $user, LaporanKeuanganUmkm $record): bool
    {
        return (bool) ($user?->isAdmin() || $user?->isPimpinan());
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(?User $user, LaporanKeuanganUmkm $record): bool
    {
        return (bool) ($user?->isAdmin() || $user?->isPimpinan());
    }

    /**
     * Determine whether the user can bulk delete models.
     */
    public function deleteAny(?User $user): bool
    {
        return (bool) ($user?->isAdmin() || $user?->isPimpinan());
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(?User $user, LaporanKeuanganUmkm $record): bool
    {
        return (bool) ($user?->isAdmin() || $user?->isPimpinan());
    }

    /**
     * Determine whether the user can bulk restore models.
     */
    public function restoreAny(?User $user): bool
    {
        return (bool) ($user?->isAdmin() || $user?->isPimpinan());
    }

    /**
     * Determine whether the user can replicate the model.
     */
    public function replicate(?User $user, LaporanKeuanganUmkm $record): bool
    {
        return (bool) ($user?->isAdmin() || $user?->isPimpinan());
    }

    /**
     * Determine whether the user can reorder models.
     */
    public function reorder(?User $user): bool
    {
        return (bool) ($user?->isAdmin() || $user?->isPimpinan());
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(?User $user, LaporanKeuanganUmkm $record): bool
    {
        return (bool) ($user?->isAdmin() || $user?->isPimpinan());
    }

    /**
     * Determine whether the user can bulk permanently delete models.
     */
    public function forceDeleteAny(?User $user): bool
    {
        return (bool) ($user?->isAdmin() || $user?->isPimpinan());
    }
}

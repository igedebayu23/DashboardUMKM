<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProfileUmkm extends Model
{
    protected $table = 'profile_umkm';

    protected $primaryKey = 'umkm_id';

    protected $fillable = [
        'nama_umkm',
        'sektor',
        'nama_pemilik',
        'lokasi',
        'no_hp',
        'jumlah_karyawan',
        'status',
    ];

    public function approve(): bool
    {
        return $this->update(['status' => 'approved']);
    }

    /**
     * @return HasMany<LaporanKeuanganUmkm, $this>
     */
    public function laporan(): HasMany
    {
        return $this->hasMany(
            LaporanKeuanganUmkm::class,
            'umkm_id',
            'umkm_id',
        );
    }
}

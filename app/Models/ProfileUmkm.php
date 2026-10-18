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
    ];

    /**
     * @return HasMany<laporanKeuanganUmkm, $this>
     */
    public function laporan(): HasMany
    {
        return $this->hasMany(
            laporanKeuanganUmkm::class,
            'umkm_id',
            'umkm_id',
        );
    }
}

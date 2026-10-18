<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class laporanKeuanganUmkm extends Model
{
    protected $table = 'laporan_keuangan_umkm';

    protected $primaryKey = 'laporan_id';

    protected $fillable = [
        'umkm_id',
        'tahun',
        'bulan',
        'pendapatan',
    ];

    protected function casts(): array
    {
        return [
            'tahun' => 'integer',
            'pendapatan' => 'decimal:2',
        ];
    }

    /**
     * @return BelongsTo<ProfileUmkm, $this>
     */
    public function umkm(): BelongsTo
    {
        return $this->belongsTo(
            ProfileUmkm::class,
            'umkm_id',
            'umkm_id',
        );
    }
}

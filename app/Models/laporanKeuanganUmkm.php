<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class laporanKeuanganUmkm extends Model
{
    protected $table = 'laporan_keuangan_umkm';
    protected $primaryKey = 'laporan_id';
    protected $guarded = [];

    public function umkm()
    {
        return $this->belongsTo(ProfileUmkm::class, 'umkm_id', 'umkm_id');
    }
}

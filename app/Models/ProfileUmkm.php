<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfileUmkm extends Model
{
    protected $table = 'profile_umkm'; 
    protected $primaryKey = 'umkm_id';  
    protected $guarded = [];

    public function laporan()
    {
        return $this->hasMany(laporanKeuanganUmkm::class, 'umkm_id', 'umkm_id');
    }
}

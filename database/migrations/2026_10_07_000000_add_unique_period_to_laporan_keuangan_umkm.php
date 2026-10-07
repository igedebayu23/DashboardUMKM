<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('laporan_keuangan_umkm', function (Blueprint $table): void {
            $table->unique(
                ['umkm_id', 'tahun', 'bulan'],
                'laporan_keuangan_umkm_umkm_tahun_bulan_unique',
            );
        });
    }

    public function down(): void
    {
        Schema::table('laporan_keuangan_umkm', function (Blueprint $table): void {
            $table->dropUnique('laporan_keuangan_umkm_umkm_tahun_bulan_unique');
        });
    }
};

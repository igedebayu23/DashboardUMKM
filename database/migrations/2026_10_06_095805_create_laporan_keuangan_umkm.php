<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('laporan_keuangan_umkm', function (Blueprint $table) {
            $table->id('laporan_id');
            $table->unsignedBigInteger('umkm_id');
            $table->year('tahun');
            $table->string('bulan');
            $table->decimal('pendapatan', 15, 2);
            $table->timestamps();

            $table->foreign('umkm_id')->references('umkm_id')->on('profile_umkm')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan_keuangan_umkm');
    }
};

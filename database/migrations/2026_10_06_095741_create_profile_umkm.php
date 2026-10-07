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
        Schema::create('profile_umkm', function (Blueprint $table) {
            $table->id('umkm_id');
            $table->string('nama_umkm');
            $table->string('sektor');
            $table->string('nama_pemilik');
            $table->string('lokasi');
            $table->string('no_hp');
            $table->integer('jumlah_karyawan')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profile_umkm');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('profile_umkm', function (Blueprint $table): void {
            $table->string('status')->default('pending')->after('jumlah_karyawan');
        });
    }

    public function down(): void
    {
        Schema::table('profile_umkm', function (Blueprint $table): void {
            $table->dropColumn('status');
        });
    }
};

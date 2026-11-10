<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Replace the legacy admin role with pegawai for all existing users.
     */
    public function up(): void
    {
        if (! DB::table('users')->where('email', 'pegawai@bi.go.id')->exists()) {
            DB::table('users')
                ->where('email', 'admin@bi.go.id')
                ->update([
                    'name' => 'Pegawai BI',
                    'email' => 'pegawai@bi.go.id',
                ]);
        }

        DB::table('users')
            ->where('role', 'admin')
            ->update(['role' => 'pegawai']);
    }

    /**
     * Restore the legacy role value when rolling back this migration.
     */
    public function down(): void
    {
        DB::table('users')
            ->where('role', 'pegawai')
            ->where('email', 'pegawai@bi.go.id')
            ->update(['role' => 'admin']);

        if (! DB::table('users')->where('email', 'admin@bi.go.id')->exists()) {
            DB::table('users')
                ->where('email', 'pegawai@bi.go.id')
                ->update([
                    'name' => 'Admin BI',
                    'email' => 'admin@bi.go.id',
                ]);
        }
    }
};

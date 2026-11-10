<?php

use App\Models\LaporanKeuanganUmkm;
use App\Models\ProfileUmkm;
use App\Models\User;

it('redirects a peserta magang to the profile form after creating a profile', function (): void {
    $pesertaMagang = User::factory()->create(['role' => 'peserta_magang']);

    $response = $this->actingAs($pesertaMagang)->post(route('profile-umkm.store'), [
        'nama_umkm' => 'UMKM Maju',
        'sektor' => 'Kuliner',
        'nama_pemilik' => 'Siti',
        'lokasi' => 'Jakarta',
        'no_hp' => '08123456789',
        'jumlah_karyawan' => 5,
    ]);

    $response->assertRedirect(route('profile-umkm.create'));
    $this->assertDatabaseHas('profile_umkm', ['nama_umkm' => 'UMKM Maju']);
});

it('redirects a peserta magang to the financial report form after creating a report', function (): void {
    $pesertaMagang = User::factory()->create(['role' => 'peserta_magang']);
    $profile = ProfileUmkm::query()->create([
        'nama_umkm' => 'UMKM Makmur',
        'sektor' => 'Kerajinan',
        'nama_pemilik' => 'Budi',
        'lokasi' => 'Bandung',
        'no_hp' => '08123456780',
        'jumlah_karyawan' => 3,
    ]);

    $response = $this->actingAs($pesertaMagang)->post(route('laporan-keuangan.store'), [
        'umkm_id' => $profile->umkm_id,
        'tahun' => 2026,
        'bulan' => 'Januari',
        'pendapatan' => 5000000,
    ]);

    $response->assertRedirect(route('laporan-keuangan.create'));
    $this->assertDatabaseHas('laporan_keuangan_umkm', [
        'umkm_id' => $profile->umkm_id,
        'tahun' => 2026,
        'bulan' => 'Januari',
    ]);
});

it('allows only pegawai to update and delete UMKM data', function (): void {
    $pegawai = User::factory()->create(['role' => 'pegawai']);
    $pimpinan = User::factory()->create(['role' => 'pimpinan']);
    $report = LaporanKeuanganUmkm::query()->create([
        'umkm_id' => ProfileUmkm::query()->create([
            'nama_umkm' => 'UMKM Sejahtera',
            'sektor' => 'Jasa',
            'nama_pemilik' => 'Ani',
            'lokasi' => 'Surabaya',
            'no_hp' => '08123456781',
            'jumlah_karyawan' => 2,
        ])->umkm_id,
        'tahun' => 2026,
        'bulan' => 'Februari',
        'pendapatan' => 3000000,
    ]);

    $this->actingAs($pimpinan)
        ->delete(route('laporan-keuangan.destroy', $report))
        ->assertForbidden();

    $this->actingAs($pegawai)
        ->delete(route('laporan-keuangan.destroy', $report))
        ->assertRedirect();

    $this->assertDatabaseMissing('laporan_keuangan_umkm', ['laporan_id' => $report->laporan_id]);
});

it('allows pegawai and pimpinan to view dashboards but not peserta magang', function (): void {
    $pegawai = User::factory()->create(['role' => 'pegawai']);
    $pimpinan = User::factory()->create(['role' => 'pimpinan']);
    $pesertaMagang = User::factory()->create(['role' => 'peserta_magang']);

    $this->actingAs($pegawai)->get(route('dashboard'))->assertOk();
    $this->actingAs($pimpinan)->get(route('dashboard'))->assertOk();
    $this->actingAs($pesertaMagang)->get(route('dashboard'))->assertForbidden();
});

it('redirects authenticated users to a page allowed for their role after login', function (): void {
    $pesertaMagang = User::factory()->create([
        'email' => 'magang-login@example.test',
        'password' => 'password',
        'role' => 'peserta_magang',
    ]);

    $this->get(route('dashboard'))->assertRedirect(route('login'));

    $this->post(route('login.store'), [
        'email' => $pesertaMagang->email,
        'password' => 'password',
    ])->assertRedirect(route('profile-umkm.create'));
});

it('limits repeated login attempts', function (): void {
    $pegawai = User::factory()->create([
        'email' => 'pegawai-login@example.test',
        'password' => 'password',
        'role' => 'pegawai',
    ]);

    for ($attempt = 0; $attempt < 5; $attempt++) {
        $this->post(route('login.store'), [
            'email' => $pegawai->email,
            'password' => 'wrong-password',
        ])->assertRedirect();
    }

    $this->post(route('login.store'), [
        'email' => $pegawai->email,
        'password' => 'password',
    ])->assertTooManyRequests();
});

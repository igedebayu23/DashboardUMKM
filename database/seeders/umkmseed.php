<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProfileUmkm;
use App\Models\laporanKeuanganUmkm;

class UmkmSeed extends Seeder
{
  public function run(): void
  {
    $sektors = ['Kuliner', 'Fashion', 'Agribisnis', 'Kerajinan', 'Jasa'];
    $namaPemilik = ['Budi Santoso', 'Siti Aminah', 'Asep Saepudin', 'Dewi Lestari', 'Abdul Jajang', 'Rina Agustin', 'Eko Prasetyo', 'Nurul Hidayah', 'Agus Setiawan', 'Sri Wahyuni'];
    $namaUsaha = ['Kripik Berkah', 'Batik Banten', 'Kopi Malabar', 'Kerajinan Bambu', 'Jasa Konveksi', 'Catering Nusantara', 'Emping Melinjo', 'Madu Baduy', 'Rajutan Cantik', 'Snack Barokah'];

    $wilayahBanten = [
      'Kota Serang, Banten',
      'Kab. Serang, Banten',
      'Kota Cilegon, Banten',
      'Kota Tangerang, Banten',
      'Kab. Tangerang, Banten',
      'Kota Tangerang Selatan, Banten',
      'Kab. Pandeglang, Banten',
      'Kab. Lebak, Banten'
    ];

    // Daftar nama bulan secara lengkap
    $daftarBulan = [
      'Januari',
      'Februari',
      'Maret',
      'April',
      'Mei',
      'Juni',
      'Juli',
      'Agustus',
      'September',
      'Oktober',
      'November',
      'Desember'
    ];

    for ($i = 1; $i <= 10; $i++) {
      $pemilik = $namaPemilik[array_rand($namaPemilik)];
      $usaha = $namaUsaha[array_rand($namaUsaha)] . ' ' . $i;

      $umkm = ProfileUmkm::create([
        'sektor' => $sektors[array_rand($sektors)],
        'nama_umkm' => $usaha,
        'nama_pemilik' => $pemilik,
        'lokasi' => $wilayahBanten[array_rand($wilayahBanten)],
        'no_hp' => '08' . rand(1111111111, 9999999999),
        'jumlah_karyawan' => rand(2, 25),
      ]);

      // Looping Tahun 2021 s.d 2025
      for ($tahun = 2021; $tahun <= 2025; $tahun++) {
        // Looping berdasarkan nama bulan di dalam array
        foreach ($daftarBulan as $namaBulan) {
          laporanKeuanganUmkm::create([
            'umkm_id' => $umkm->umkm_id,
            'tahun' => $tahun,
            'bulan' => $namaBulan,
            'pendapatan' => rand(10, 150) * 100000,
          ]);
        }
      }
    }
  }
}

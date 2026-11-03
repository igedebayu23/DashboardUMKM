<?php

namespace Database\Seeders;

use App\Models\LaporanKeuanganUmkm;
use App\Models\ProfileUmkm;
use Illuminate\Database\Seeder;

class UmkmSeed extends Seeder
{
    public function run(): void
    {
        // Data disusun sejajar berdasarkan indeks (0 - 9)
        $namaUsaha = [
            'Kripik Berkah',
            'Batik Banten',
            'Kopi Malabar',
            'Kerajinan Bambu',
            'Jasa Konveksi',
            'Catering Nusantara',
            'Emping Melinjo',
            'Madu Baduy',
            'Rajutan Cantik',
            'Snack Barokah',
        ];

        $namaPemilik = [
            'Budi Santoso',
            'Siti Aminah',
            'Asep Saepudin',
            'Dewi Lestari',
            'Abdul Jajang',
            'Rina Agustin',
            'Eko Prasetyo',
            'Nurul Hidayah',
            'Agus Setiawan',
            'Sri Wahyuni',
        ];

        // Sektor disesuaikan secara presisi dengan masing-masing UMKM di atas
        $sektors = [
            'Kuliner',   // Kripik Berkah
            'Fashion',   // Batik Banten
            'Kuliner',   // Kopi Malabar
            'Kerajinan', // Kerajinan Bambu
            'Jasa',      // Jasa Konveksi
            'Kuliner',   // Catering Nusantara
            'Kuliner',   // Emping Melinjo
            'Agribisnis', // Madu Baduy
            'Fashion',   // Rajutan Cantik
            'Kuliner',    // Snack Barokah
        ];

        $wilayahBanten = [
            'Kota Serang, Banten',
            'Kab. Serang, Banten',
            'Kota Cilegon, Banten',
            'Kota Tangerang, Banten',
            'Kab. Tangerang, Banten',
            'Kota Tangerang Selatan, Banten',
            'Kab. Pandeglang, Banten',
            'Kab. Lebak, Banten',
        ];

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
            'Desember',
        ];

        // Looping berdasarkan indeks 0 sampai 9
        for ($i = 0; $i < 10; $i++) {
            $umkm = ProfileUmkm::create([
                'sektor' => $sektors[$i],
                'nama_umkm' => $namaUsaha[$i],
                'nama_pemilik' => $namaPemilik[$i],
                'lokasi' => $wilayahBanten[array_rand($wilayahBanten)],
                'no_hp' => '08'.rand(1111111111, 9999999999),
                'jumlah_karyawan' => rand(2, 25),
            ]);

            // Looping Laporan Keuangan (2021 s.d. 2025)
            for ($tahun = 2021; $tahun <= 2025; $tahun++) {
                foreach ($daftarBulan as $namaBulan) {
                    LaporanKeuanganUmkm::create([
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

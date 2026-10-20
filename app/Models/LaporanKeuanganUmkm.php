<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class LaporanKeuanganUmkm extends Model
{
    protected $table = 'laporan_keuangan_umkm';

    protected $primaryKey = 'laporan_id';

    protected $fillable = [
        'umkm_id',
        'tahun',
        'bulan',
        'pendapatan',
    ];

    protected function casts(): array
    {
        return [
            'tahun' => 'integer',
            'pendapatan' => 'decimal:2',
        ];
    }

    /**
     * @return BelongsTo<ProfileUmkm, $this>
     */
    public function umkm(): BelongsTo
    {
        return $this->belongsTo(
            ProfileUmkm::class,
            'umkm_id',
            'umkm_id',
        );
    }

    /**
     * @return Collection<int, object{tahun: int, total: float}>
     */
    public static function getGrafikTahunan(): Collection
    {
        return static::query()
            ->select('tahun', DB::raw('SUM(pendapatan) as total'))
            ->groupBy('tahun')
            ->orderBy('tahun')
            ->get()
            ->map(fn (object $report): object => (object) [
                'tahun' => (int) $report->tahun,
                'total' => (float) $report->total,
            ])
            ->values();
    }

    /**
     * @return array<int, array{
     *     nama_umkm: string,
     *     tahun_sebelumnya: int,
     *     pendapatan_sebelumnya: float,
     *     tahun: int,
     *     pendapatan: float,
     *     penurunan: float
     * }>
     */
    public static function getAnalisisPenurunan(): array
    {
        $annualReports = static::query()
            ->join('profile_umkm', 'profile_umkm.umkm_id', '=', 'laporan_keuangan_umkm.umkm_id')
            ->select(
                'laporan_keuangan_umkm.umkm_id',
                'profile_umkm.nama_umkm',
                'laporan_keuangan_umkm.tahun',
                DB::raw('SUM(laporan_keuangan_umkm.pendapatan) as total_pendapatan'),
            )
            ->groupBy(
                'laporan_keuangan_umkm.umkm_id',
                'profile_umkm.nama_umkm',
                'laporan_keuangan_umkm.tahun',
            )
            ->orderBy('laporan_keuangan_umkm.umkm_id')
            ->orderBy('laporan_keuangan_umkm.tahun')
            ->get()
            ->groupBy('umkm_id');

        return $annualReports
            ->flatMap(function (Collection $reports): array {
                $reports = $reports->values();

                if ($reports->count() < 2) {
                    return [];
                }

                $current = $reports->last();
                $previous = $reports->get($reports->count() - 2);

                if ((float) $current->total_pendapatan >= (float) $previous->total_pendapatan) {
                    return [];
                }

                return [[
                    'nama_umkm' => (string) $current->nama_umkm,
                    'tahun_sebelumnya' => (int) $previous->tahun,
                    'pendapatan_sebelumnya' => (float) $previous->total_pendapatan,
                    'tahun' => (int) $current->tahun,
                    'pendapatan' => (float) $current->total_pendapatan,
                    'penurunan' => (float) $previous->total_pendapatan - (float) $current->total_pendapatan,
                ]];
            })
            ->values()
            ->all();
    }
}

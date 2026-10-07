<?php

namespace App\Filament\Pages;

use App\Models\laporanKeuanganUmkm;
use Filament\Pages\Page;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use UnitEnum;

class PenurunanUmkm extends Page implements HasTable
{
    use InteractsWithTable;

    protected static string|UnitEnum|null $navigationGroup = 'Analisis';

    protected static ?string $navigationLabel = 'Penurunan Pendapatan UMKM';

    protected static ?string $title = 'UMKM yang Mengalami Penurunan';

    protected static ?int $navigationSort = 2;

    protected string $view = 'filament.pages.penurunan-umkm';

    /**
     * @var array<int, array{nama_umkm: string, tahun_sebelumnya: int, pendapatan_sebelumnya: float, tahun: int, pendapatan: float, penurunan: float}>
     */
    public array $decliningUmkms = [];

    public function mount(): void
    {
        $annualReports = laporanKeuanganUmkm::query()
            ->select('umkm_id', 'tahun', DB::raw('SUM(pendapatan) as total_pendapatan'))
            ->with('umkm:umkm_id,nama_umkm')
            ->groupBy('umkm_id', 'tahun')
            ->orderBy('umkm_id')
            ->orderBy('tahun')
            ->get()
            ->groupBy('umkm_id');

        $this->decliningUmkms = $annualReports
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
                    'nama_umkm' => $current->umkm->nama_umkm,
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

    public function table(Table $table): Table
    {
        return $table
            ->heading('UMKM dengan Pendapatan Menurun')
            ->description('Perbandingan total pendapatan setiap UMKM dengan tahun sebelumnya.')
            ->records(function (?string $search = null): array {
                $records = collect($this->decliningUmkms);

                if (filled($search)) {
                    $search = str($search)->lower()->toString();

                    $records = $records->filter(function (array $record) use ($search): bool {
                        return str($record['nama_umkm'])->lower()->contains($search)
                            || str($record['tahun_sebelumnya'])->contains($search)
                            || str($record['tahun'])->contains($search);
                    });
                }

                return $records->values()->all();
            })
            ->columns([
                TextColumn::make('nama_umkm')
                    ->label('Nama UMKM')
                    ->searchable()
                    ->sortable()
                    ->weight('medium'),
                TextColumn::make('tahun_sebelumnya')
                    ->label('Tahun Sebelumnya')
                    ->sortable(),
                TextColumn::make('pendapatan_sebelumnya')
                    ->label('Pendapatan Sebelumnya')
                    ->formatStateUsing(fn (float|int|string|null $state): string => 'Rp '.number_format((float) $state, 0, ',', '.'))
                    ->sortable(),
                TextColumn::make('tahun')
                    ->label('Tahun Terbaru')
                    ->sortable(),
                TextColumn::make('pendapatan')
                    ->label('Pendapatan Terbaru')
                    ->formatStateUsing(fn (float|int|string|null $state): string => 'Rp '.number_format((float) $state, 0, ',', '.'))
                    ->sortable(),
                TextColumn::make('penurunan')
                    ->label('Penurunan')
                    ->formatStateUsing(fn (float|int|string|null $state): string => 'Rp '.number_format((float) $state, 0, ',', '.'))
                    ->badge()
                    ->color('danger')
                    ->sortable(),
            ])
            ->searchable()
            ->paginated(false);
    }
}

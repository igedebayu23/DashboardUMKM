<?php

namespace App\Filament\Pages;

use App\Services\UmkmRevenueAnalysisService;
use Filament\Pages\Page;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use UnitEnum;

class PenurunanUmkm extends Page implements HasTable
{
    use InteractsWithTable;

    protected static string|UnitEnum|null $navigationGroup = 'Analisis';

    protected static ?string $navigationLabel = 'Penurunan Pendapatan UMKM';

    protected static ?string $title = 'UMKM yang Mengalami Penurunan';

    protected static ?int $navigationSort = 2;

    public static function canAccess(): bool
    {
        return (bool) (auth()->user()?->isAdmin() || auth()->user()?->isPimpinan());
    }

    protected string $view = 'filament.pages.penurunan-umkm';

    /**
     * @var array<int, array{nama_umkm: string, tahun_sebelumnya: int, pendapatan_sebelumnya: float, tahun: int, pendapatan: float, penurunan: float}>
     */
    public array $decliningUmkms = [];

    public function mount(UmkmRevenueAnalysisService $analysis): void
    {
        $this->decliningUmkms = $analysis->decliningUmkms();
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
                            || str((string) $record['tahun_sebelumnya'])->contains($search)
                            || str((string) $record['tahun'])->contains($search);
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

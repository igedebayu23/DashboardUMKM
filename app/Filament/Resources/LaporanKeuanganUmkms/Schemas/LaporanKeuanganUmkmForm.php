<?php

namespace App\Filament\Resources\LaporanKeuanganUmkms\Schemas;

use App\Models\laporanKeuanganUmkm;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;
use Illuminate\Database\Eloquent\Builder;

class LaporanKeuanganUmkmForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('umkm_id')
                    ->label('Nama UMKM')
                    ->relationship('umkm', 'nama_umkm')
                    ->searchable()
                    ->preload()
                    ->scopedUnique(
                        model: laporanKeuanganUmkm::class,
                        column: 'umkm_id',
                        modifyQueryUsing: fn(Builder $query, Get $get): Builder => $query
                            ->where('tahun', $get('tahun'))
                            ->where('bulan', $get('bulan')),
                    )
                    ->validationMessages([
                        'unique' => 'Laporan untuk UMKM, tahun, dan bulan tersebut sudah ada.',
                    ])
                    ->required(),
                TextInput::make('tahun')
                    ->integer()
                    ->minValue(2021)
                    ->maxValue(9999)
                    ->required(),
                Select::make('bulan')
                    ->options([
                        'Januari' => 'Januari',
                        'Februari' => 'Februari',
                        'Maret' => 'Maret',
                        'April' => 'April',
                        'Mei' => 'Mei',
                        'Juni' => 'Juni',
                        'Juli' => 'Juli',
                        'Agustus' => 'Agustus',
                        'September' => 'September',
                        'Oktober' => 'Oktober',
                        'November' => 'November',
                        'Desember' => 'Desember',
                    ])
                    ->searchable()
                    ->required(),
                TextInput::make('pendapatan')
                    ->numeric()
                    ->required(),
            ]);
    }
}

<?php

namespace App\Filament\Resources\LaporanKeuanganUmkms\Tables;

use App\Filament\Resources\LaporanKeuanganUmkms\LaporanKeuanganUmkmResource;
use App\Filament\Resources\LaporanKeuanganUmkms\Pages\ListLaporanKeuanganUmkms;
use App\Models\laporanKeuanganUmkm;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class LaporanKeuanganUmkmsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('umkm.nama_umkm')
                    ->label('Nama UMKM')
                    ->searchable()
                    ->url(fn (laporanKeuanganUmkm $record): string => LaporanKeuanganUmkmResource::getUrl('index', [
                        'umkmId' => $record->umkm_id,
                    ])),
                TextColumn::make('tahun')
                    ->sortable()
                    ->visible(fn (ListLaporanKeuanganUmkms $livewire): bool => filled($livewire->umkmId)),
                TextColumn::make('bulan')
                    ->sortable()
                    ->visible(fn (ListLaporanKeuanganUmkms $livewire): bool => filled($livewire->umkmId)),
                TextColumn::make('pendapatan')
                    ->numeric(decimalPlaces: 2)
                    ->sortable()
                    ->visible(fn (ListLaporanKeuanganUmkms $livewire): bool => filled($livewire->umkmId)),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make()
                    ->visible(fn (ListLaporanKeuanganUmkms $livewire): bool => filled($livewire->umkmId)),
            ]);
    }
}

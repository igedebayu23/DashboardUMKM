<?php

namespace App\Filament\Resources\ProfileUmkms\Tables;

use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ProfileUmkmsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama_umkm')
                    ->searchable(),
                TextColumn::make('sektor')
                    ->searchable(),
                TextColumn::make('nama_pemilik')
                    ->searchable(),
                TextColumn::make('lokasi')
                    ->searchable(),
                TextColumn::make('no_hp')
                    ->searchable(),
                TextColumn::make('jumlah_karyawan')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ]);
    }
}

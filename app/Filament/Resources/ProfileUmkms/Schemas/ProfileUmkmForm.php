<?php

namespace App\Filament\Resources\ProfileUmkms\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ProfileUmkmForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nama_umkm')
                    ->required(),
                TextInput::make('sektor')
                    ->required(),
                TextInput::make('nama_pemilik')
                    ->required(),
                TextInput::make('lokasi')
                    ->required(),
                TextInput::make('no_hp')
                    ->required(),
                TextInput::make('jumlah_karyawan')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }
}

<?php

namespace App\Filament\Resources\LaporanKeuanganUmkms;

use App\Filament\Resources\LaporanKeuanganUmkms\Pages\CreateLaporanKeuanganUmkm;
use App\Filament\Resources\LaporanKeuanganUmkms\Pages\EditLaporanKeuanganUmkm;
use App\Filament\Resources\LaporanKeuanganUmkms\Pages\ListLaporanKeuanganUmkms;
use App\Filament\Resources\LaporanKeuanganUmkms\Schemas\LaporanKeuanganUmkmForm;
use App\Filament\Resources\LaporanKeuanganUmkms\Tables\LaporanKeuanganUmkmsTable;
use App\Models\laporanKeuanganUmkm;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class LaporanKeuanganUmkmResource extends Resource
{
    protected static ?string $model = laporanKeuanganUmkm::class;

    protected static ?string $pluralModelLabel = 'Laporan Keuangan UMKM';

    protected static ?string $modelLabel = 'Laporan Keuangan UMKM';

    protected static string|UnitEnum|null $navigationGroup = 'View';

    protected static ?string $navigationLabel = 'Laporan Keuangan UMKM';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return LaporanKeuanganUmkmForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return LaporanKeuanganUmkmsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListLaporanKeuanganUmkms::route('/'),
            'create' => CreateLaporanKeuanganUmkm::route('/create'),
            'edit' => EditLaporanKeuanganUmkm::route('/{record}/edit'),
        ];
    }
}

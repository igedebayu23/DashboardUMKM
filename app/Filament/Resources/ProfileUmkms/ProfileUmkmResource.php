<?php

namespace App\Filament\Resources\ProfileUmkms;

use App\Filament\Resources\ProfileUmkms\Pages\CreateProfileUmkm;
use App\Filament\Resources\ProfileUmkms\Pages\EditProfileUmkm;
use App\Filament\Resources\ProfileUmkms\Pages\ListProfileUmkms;
use App\Filament\Resources\ProfileUmkms\Schemas\ProfileUmkmForm;
use App\Filament\Resources\ProfileUmkms\Tables\ProfileUmkmsTable;
use App\Models\ProfileUmkm;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class ProfileUmkmResource extends Resource
{
    protected static ?string $model = ProfileUmkm::class;

    protected static ?string $pluralModelLabel = 'Profile UMKM';

    protected static ?string $modelLabel = 'Profile UMKM';

    protected static string|UnitEnum|null $navigationGroup = 'View';

    protected static ?string $navigationLabel = 'Profile UMKM';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return ProfileUmkmForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ProfileUmkmsTable::configure($table);
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
            'index' => ListProfileUmkms::route('/'),
            'create' => CreateProfileUmkm::route('/create'),
            'edit' => EditProfileUmkm::route('/{record}/edit'),
        ];
    }
}

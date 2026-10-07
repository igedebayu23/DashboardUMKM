<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use UnitEnum;

class GrafikPendapatanTahunan extends Page
{
    protected static string|UnitEnum|null $navigationGroup = 'Analisis';

    protected static ?string $navigationLabel = 'Grafik Pendapatan Tahunan';

    protected static ?string $title = 'Grafik Pendapatan Tahunan';

    protected static ?int $navigationSort = 1;

    protected string $view = 'filament.pages.grafik-pendapatan-tahunan';
}

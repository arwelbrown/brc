<?php

namespace App\Filament\Pages;

use FilipFonal\FilamentLogManager\Pages\Logs as FilipFonalLogs;

class Logs extends FilipFonalLogs
{
    public static function shouldRegisterNavigation(): bool
    {
        return auth()->user()->email == 'arwel@brc.com';
    }
}
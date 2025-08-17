<?php

namespace App\Filament\Pages;

use App\Models\User;
use Filament\Pages\Page;

class Settings extends Page
{
    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-cog';

    protected string $view = 'filament.pages.settings';

    public static function shouldRegisterNavigation(): bool
    {
        return auth()->user()->canManageSettings();
    }

    public function mount(): void
    {
        abort_unless(auth()->user()->canManageSettings(), 403);
    }
}

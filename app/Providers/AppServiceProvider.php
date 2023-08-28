<?php

namespace App\Providers;

use Filament\Forms\Components\TextInput;
use Illuminate\Pagination\Paginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use Reworck\FilamentSettings\FilamentSettings;
use Filament\Facades\Filament;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Model::unguard();
        FilamentSettings::setFormFields([
            TextInput::make('title'),
        ]);

        Paginator::useBootstrap();

        Filament::serving(function () {
            // Using Vite
            Filament::registerViteTheme('resources/css/filament.css');
        });
    }
}

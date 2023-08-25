<?php

namespace App\Providers;

use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use Reworck\FilamentSettings\FilamentSettings;

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
    }
}

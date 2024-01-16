<?php

namespace App\Filament\Resources\UniverseResource\Pages;

use App\Filament\Resources\UniverseResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListUniverses extends ListRecords
{
    protected static string $resource = UniverseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}

<?php

namespace App\Filament\Resources\Canons\Pages;

use App\Filament\Resources\CanonResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCanons extends ListRecords
{
    protected static string $resource = CanonResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}

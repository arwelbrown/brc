<?php

namespace App\Filament\Resources\UniverseResource\Pages;

use App\Filament\Resources\UniverseResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUniverse extends EditRecord
{
    protected static string $resource = UniverseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

<?php

namespace App\Filament\Resources\UniverseResource\Pages;

use App\Filament\Resources\UniverseResource;
use Filament\Resources\Pages\CreateRecord;

class CreateUniverse extends CreateRecord
{
    protected static string $resource = UniverseResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}

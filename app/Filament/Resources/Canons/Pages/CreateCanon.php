<?php

namespace App\Filament\Resources\Canons\Pages;

use App\Filament\Resources\CanonResource;
use Filament\Resources\Pages\CreateRecord;

class CreateCanon extends CreateRecord
{
    protected static string $resource = CanonResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}

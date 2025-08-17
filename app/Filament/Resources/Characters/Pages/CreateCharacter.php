<?php

namespace App\Filament\Resources\Characters\Pages;

use App\Filament\Resources\CharacterResource;
use Filament\Resources\Pages\CreateRecord;

class CreateCharacter extends CreateRecord
{
    protected static string $resource = CharacterResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}

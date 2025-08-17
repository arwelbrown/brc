<?php

namespace App\Filament\Resources\Characters\Pages;

use Filament\Actions\DeleteAction;
use App\Filament\Resources\CharacterResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCharacter extends EditRecord
{
    protected static string $resource = CharacterResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}

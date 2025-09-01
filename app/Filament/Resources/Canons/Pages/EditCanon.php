<?php

namespace App\Filament\Resources\Canons\Pages;

use Filament\Actions\DeleteAction;
use App\Filament\Resources\CanonResource;
use Filament\Resources\Pages\EditRecord;

class EditCanon extends EditRecord
{
    protected static string $resource = CanonResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}

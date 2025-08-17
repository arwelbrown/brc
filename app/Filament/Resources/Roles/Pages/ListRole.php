<?php

namespace App\Filament\Resources\Roles\Pages;

use Filament\Actions\CreateAction;
use App\Filament\Resources\RoleResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRole extends ListRecords
{
    protected static string $resource = RoleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}

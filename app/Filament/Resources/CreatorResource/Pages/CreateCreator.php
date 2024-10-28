<?php

namespace App\Filament\Resources\CreatorResource\Pages;

use App\Filament\Resources\CreatorResource;
use App\Models\CreatorType;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCreator extends CreateRecord
{
    protected static string $resource = CreatorResource::class;

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $creatorTypes = CreatorType::whereIn('id', $data['creator_type'])->get();

        $data['creator_type'] = [];

        foreach ($creatorTypes as $type) {
            $data['creator_type'][] = $type->type;
        }

        return $data;
    }
}

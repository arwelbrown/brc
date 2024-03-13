<?php

namespace App\Filament\Resources\CreatorResource\Pages;

use App\Filament\Resources\CreatorResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use App\Models\CreatorType;

use function PHPSTORM_META\type;

class EditCreator extends EditRecord
{
    protected static string $resource = CreatorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

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

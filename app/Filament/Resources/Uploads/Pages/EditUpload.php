<?php

namespace App\Filament\Resources\Uploads\Pages;

use Filament\Actions\DeleteAction;
use App\Filament\Resources\UploadResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUpload extends EditRecord
{
    protected static string $resource = UploadResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}

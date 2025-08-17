<?php

namespace App\Filament\Resources\Uploads\Pages;

use App\Enums\Uploads\UploadStatusEnum;
use App\Filament\Resources\UploadResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateUpload extends CreateRecord
{
    protected static string $resource = UploadResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = auth()->user()->id;

        if (empty($data['status'])) {
            $data['status'] = UploadStatusEnum::PENDING->value;
        }

        return $data;
    }
}

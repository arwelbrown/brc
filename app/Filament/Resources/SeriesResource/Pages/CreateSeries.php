<?php

namespace App\Filament\Resources\SeriesResource\Pages;

use App\Filament\Resources\SeriesResource;
use Filament\Resources\Pages\CreateRecord;
use App\Formatters\SlugFormatter;

class CreateSeries extends CreateRecord
{
    protected static string $resource = SeriesResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['series_slug'] = SlugFormatter::formatSlug($data['series_name']);
        return $data;
    }
}

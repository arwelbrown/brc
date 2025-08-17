<?php

namespace App\Filament\Resources\Submissions\Pages;

use App\Filament\Resources\SubmissionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSubmissions extends ListRecords
{
    protected static string $resource = SubmissionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            //
        ];
    }
}

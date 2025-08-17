<?php

namespace App\Filament\Resources\Newsletters\Pages;

use Filament\Actions\CreateAction;
use App\Filament\Resources\NewsletterResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListNewsletters extends ListRecords
{
    protected static string $resource = NewsletterResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}

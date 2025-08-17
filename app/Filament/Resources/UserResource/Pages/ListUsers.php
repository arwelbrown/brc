<?php

namespace App\Filament\Resources\UserResource\Pages;

use Filament\Actions\CreateAction;
use App\Filament\Resources\UserResource;
use App\Mail\BookSold;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Mail;

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        Mail::to('sales@brc.com')->send(new BookSold());

        return [
            CreateAction::make(),
        ];
    }
}

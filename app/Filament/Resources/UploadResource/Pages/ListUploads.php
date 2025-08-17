<?php

namespace App\Filament\Resources\UploadResource\Pages;

use Filament\Actions\CreateAction;
use App\Filament\Resources\UploadResource;
use App\Models\Upload;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListUploads extends ListRecords
{
    protected static string $resource = UploadResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }

    protected function getTableQuery(): Builder
    {
        $query = Upload::query();
        
        $userId = auth()->user()->id;

        if (!auth()->user()->hasRole('admin')) {
            $query->where('user_id', '=', $userId);
        }

        return $query;
    }
}

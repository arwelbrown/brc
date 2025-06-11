<?php

namespace App\Filament\Resources\BookResource\Pages;

use App\Filament\Resources\BookResource;
use App\Models\Book;
use App\Models\Series;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListBooks extends ListRecords
{
    protected static string $resource = BookResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }

    protected function getTableQuery(): Builder
    {
        $query = Book::query();

        $permissions = auth()->user()->getRelation('roles')[0]->permissions;

        $seriesIds = [];

        foreach ($permissions as $index => $permission) {
            $editPerm = $permission->getAttributes()['name'];

            if (!in_array($editPerm, ['Edit All', 'Edit Permissions', 'Edit Roles', 'Edit Users'])) {
                $seriesName = explode('Edit ', $editPerm)[1];
                $seriesIds[] = Series::where('series_name', '=', $seriesName)->get()[0]->id;
            }
        }

        if (!empty($seriesIds)) {
            $query = Book::query()->whereIn('series_id', $seriesIds);
        } else {
            $query = Book::query();
        }

        return $query;
    }
}

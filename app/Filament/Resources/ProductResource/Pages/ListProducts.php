<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource;
use App\Models\Series;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListProducts extends ListRecords
{
    protected static string $resource = ProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getTableQuery(): Builder
    {
        $query = parent::getTableQuery()->withoutGlobalScopes();
        $permissions = auth()->user()->getRelation('roles')[0]->permissions;

        $seriesIds = [];

        foreach ($permissions as $index => $permission) {
            $editPerm = $permission->getAttributes()['name'];

            if (! in_array($editPerm, ['Edit All', 'Edit Permissions', 'Edit Roles', 'Edit Users'])) {
                $seriesName = explode('Edit ', $editPerm)[1];
                $seriesIds[] = Series::where('series_name', '=', $seriesName)->get()[0]->id;
            }
        }

        if (! empty($seriesIds)) {
            $query = parent::getTableQuery()->withoutGlobalScopes()->whereIn('series_id', $seriesIds);

        } else {
            $query = parent::getTableQuery()->withoutGlobalScopes();
        }

        return $query;
    }
}

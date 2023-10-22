<?php

namespace App\Filament\Resources\SeriesResource\Pages;

use App\Filament\Resources\SeriesResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListSeries extends ListRecords
{
    protected static string $resource = SeriesResource::class;

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

        $seriesNames = [];

        foreach ($permissions as $index => $permission) {
            $editPerm = $permission->getAttributes()['name'];
            if (! in_array($editPerm, ['Edit All', 'Edit Permissions', 'Edit Roles', 'Edit Users'])) {
                $seriesNames[] = explode('Edit ', $editPerm)[1];
            }
        }

        if (! empty($seriesNames)) {
            $query = parent::getTableQuery()->withoutGlobalScopes()->whereIn('series_name', $seriesNames);

        } else {
            $query = parent::getTableQuery()->withoutGlobalScopes();
        }

        return $query;
    }
}

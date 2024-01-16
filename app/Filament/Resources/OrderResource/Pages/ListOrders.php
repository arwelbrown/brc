<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Filament\Resources\OrderResource;
use Filament\Resources\Pages\ListRecords;
use App\Models\Order;
use Illuminate\Database\Eloquent\Builder;

class ListOrders extends ListRecords
{
    protected static string $resource = OrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            //
        ];
    }


    protected function getTableQuery(): Builder
    {       
        $permissions = auth()->user()->getRelation('roles')[0]->permissions;

        $isAdmin = array_map(function($permission) {
            return in_array($permission['name'], ['Edit All', 'Edit Permissions', 'Edit Roles', 'Edit Users']);
        }, $permissions->toArray());

        if (!$isAdmin[0]) {
            $query = Order::query()->where('user_id', auth()->id());
        } else {
            $query = Order::query();
        }

        return $query;
    }
}

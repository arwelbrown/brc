<?php

namespace App\Filament\Resources\InventoryResource\Widgets;

use App\Models\Product;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Database\Eloquent\Model;

class StockWidget extends BaseWidget
{
    public ?Model $record = null;

    protected function getStats(): array
    {
        $record = $this->record;

        $stock = Product::where('id', $record->id)->pluck('stock')[0];

        return [
            Stat::make('Current Stock', $stock),
        ];
    }
}

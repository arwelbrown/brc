<?php

namespace App\Filament\Resources\InventoryResource\Pages;

use App\Filament\Resources\InventoryResource;
use App\Filament\Resources\InventoryResource\Widgets\StockWidget;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Redirect;

class EditInventory extends EditRecord
{
    protected static ?string $title = 'Order Stock';

    protected static string $resource = InventoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $stripeData = [];

        // Need to get product name

        $stripeData['quantity'] = $data['purchase_books'];
        $stripeData['product_name'] = $data['product_title'];
        
        // remove fields we don't want to submit to our DB
        unset($data['purchase_books']);
        unset($data['order_total']);
        unset($data['product_title']);
        unset($data['Check your order and head to the payments page!']);

        Redirect::route('checkout')->with(['data' => $stripeData]);

        return $data;
    }

    protected function getHeaderWidgets(): array
    {
        return [
            StockWidget::class,
        ];
    }
}

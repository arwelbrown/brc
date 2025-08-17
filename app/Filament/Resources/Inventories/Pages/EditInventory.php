<?php

namespace App\Filament\Resources\Inventories\Pages;

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
            //
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $stripeData = [];

        switch ((int) $data['purchase_books']) {
            case 0:
                $stripeData['quantity'] = 25;
                break;
            case 1:
                $stripeData['quantity'] = 50;
                break;
            case 2:
                $stripeData['quantity'] = 100;
                break;
        }

        // Need to get product name
        $stripeData['product_name'] = $data['product_title'];

        // pinch the original url
        $stripeData['start_url'] = url()->previous();
        
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

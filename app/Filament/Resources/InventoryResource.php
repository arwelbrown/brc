<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InventoryResource\Pages;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Forms\Components\Section;
use Filament\Forms\Get;
use Filament\Forms\Set;
use App\Models\Product;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\Wizard\Step;
use App\Forms\Components\PaymentButton;
use App\Filament\Resources\InventoryResource\Widgets\StockWidget;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Hidden;

class InventoryResource extends Resource
{
    protected static ?string $model = Product::class;
    protected static ?string $navigationLabel = 'Inventory';
    protected static ?string $modelLabel = 'Inventory';
    protected static ?string $navigationIcon = 'heroicon-s-plus';
    protected static ?string $navigationGroup = 'Product Management';

    public static function form(Form $form): Form
    {
        define('INITIAL_STOCK', $form->model['stock']);

        return $form
            ->schema([
                Wizard::make([
                    Step::make('Quanitity')
                        ->schema([
                            Select::make('purchase_books')
                                ->options([25, 50, 100])
                                ->required()
                                ->autofocus()
                                ->live(onBlur: true)
                                ->afterStateUpdated(
                                    function(Set $set, Get $get, ?int $state) {
                                        $set('product_title', $get('product_name'));

                                        $quantities = [
                                            '' => null,
                                            0 => 25,
                                            1 => 50,
                                            2 => 100
                                        ];
                                        
                                        $quantity = $quantities[$state];

                                        if ($quantity) {
                                            $set('stock', INITIAL_STOCK + $quantity);
                                            $set('order_total', $quantity * env('PHYSICAL_ORDER_PRICE'));
                                        } else {
                                            $set('stock', INITIAL_STOCK);
                                            $set('order_total', 0);
                                        }
                                    }
                                )
                                ->placeholder('Please Select...'),
                            TextInput::make('stock')
                                ->numeric()
                                ->live()
                                ->hidden(),
                            Hidden::make('product_title')
                                ->live()                   
                        ]),
                    Step::make('Payment')
                        ->schema([
                            PaymentButton::make('Check your order and head to the payments page!')
                        ]),
                ]),
                Section::make('Order Details')
                    ->schema([
                        TextInput::make('product_name')
                            ->disabled(),
                        TextInput::make('stock')    
                            ->disabled()
                            ->numeric()
                            ->label('Stock After Purchase'),
                        TextInput::make('order_total')
                            ->numeric()
                            ->inputMode('decimal')
                            ->disabled()
                            ->default(0)
                            ->prefixIcon('heroicon-m-currency-dollar')
                    ])
                    ->columnSpan(1),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('product_name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('series.series_name')
                    ->searchable()
                    ->sortable(),
                IconColumn::make('active')
                    ->boolean(),
                TextColumn::make('stock')
            ])
            ->filters([
                //
            ])
            ->actions([
                EditAction::make()
                    ->label('Purchase Stock')
                    ->icon('heroicon-s-plus'),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListInventories::route('/'),
            'edit' => Pages\EditInventory::route('/{record}/edit'),
        ];
    }

    public static function getWidgets(): array
    {   
        return [
            StockWidget::class,
        ];
    }
}

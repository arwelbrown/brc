<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers;
use App\Models\Order;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use App\Models\User;
use Filament\Forms\Components\Select;
use Filament\Support\RawJs;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';
    protected static ?string $navigationGroup = 'Product Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Order Details')
                    ->schema([
                        TextInput::make('order_id')
                            ->disabled(),
                        TextInput::make('user_id')
                            ->label('Order Placed By')
                            ->disabled()
                            ->formatStateUsing(function(string $state) {
                                $user = User::where('id', $state)->first();
                                return $user->name . ' - ' . $user->email;
                            }),
                        TextInput::make('quantity')
                            ->disabled()
                            ->numeric(),
                        TextInput::make('order_total')
                            ->live()
                            ->numeric()
                            ->inputMode('decimal')
                            ->disabled()
                            ->formatStateUsing(fn (string $state): int => (int) $state / 100)
                            ->prefixIcon('heroicon-m-currency-dollar'),
                        Textarea::make('order_details')
                            ->autofocus()
                            ->disabled()
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
                    Section::make('Order Actions')
                            ->schema([
                                Select::make('order_status')
                                    ->options([
                                        'order placed' => 'Order Placed',
                                        'dispatched' => 'Dispatched',
                                        'delivered' => 'Delivered',
                                    ])
                                    ->disabled(function() {
                                        $role = auth()->user()->getRelation('roles')[0]->toArray();
                                        return $role['name'] != 'admin';
                                    })
                            ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('order_id')
                    ->searchable(),
                TextColumn::make('user_id'),
                TextColumn::make('quantity'),
                TextColumn::make('order_total')
                    ->money('usd', 100),
                TextColumn::make('order_status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'order placed' => 'warning',
                        'dispatched' => 'info',
                        'delivered' => 'success'
                    }),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->label('View Order')
                    ->icon('heroicon-s-eye'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListOrders::route('/'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}

<?php

namespace App\Filament\Resources;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Actions\EditAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use App\Filament\Resources\Orders\Pages\ListOrders;
use App\Filament\Resources\Orders\Pages\EditOrder;
use App\Filament\Resources\Orders\Pages;
use App\Filament\Resources\Orders\RelationManagers;
use App\Models\Order;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
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

  protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-currency-dollar';
  protected static string | \UnitEnum | null $navigationGroup = 'Product Management';

  public static function form(Schema $schema): Schema
  {
    return $schema
      ->components([
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
      ->recordActions([
        EditAction::make()
          ->label('View Order')
          ->icon('heroicon-s-eye'),
      ])
      ->toolbarActions([
        BulkActionGroup::make([
          DeleteBulkAction::make(),
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
      'index' => ListOrders::route('/'),
      'edit' => EditOrder::route('/{record}/edit'),
    ];
  }

  public static function shouldRegisterNavigation(): bool
  {
    return auth()->user()->hasRole('super-admin');
  }
}

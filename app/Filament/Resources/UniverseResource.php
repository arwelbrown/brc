<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UniverseResource\Pages;
use App\Filament\Resources\UniverseResource\RelationManagers\SeriesRelationManager;
use App\Models\Universe;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\EditAction;
use App\Formatters\SlugFormatter;

class UniverseResource extends Resource
{
    protected static ?string $model = Universe::class;

    protected static ?string $navigationGroup = 'Product Management';
    protected static ?string $navigationIcon = 'heroicon-o-globe-alt';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('universe_name')
                    ->autofocus()
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(fn (callable $set, $state) => !empty($state) ? $set('universe_slug', SlugFormatter::formatSlug($state)) : $set('universe_slug', '')),
                TextInput::make('universe_slug')
                    ->disabled()
                    ->autofocus()
                    ->required()
                    ->reactive(),
            ]);
    }

    public static function table(Table $table): Table
{
        return $table
            ->columns([
                TextColumn::make('universe_name')
            ])
            ->filters([
                //
            ])
            ->actions([
                EditAction::make(),
            ])
            ->bulkActions([
                // 
            ]);
    }
    
    public static function getRelations(): array
    {
        return [
            SeriesRelationManager::class
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUniverses::route('/'),
            'create' => Pages\CreateUniverse::route('/create'),
            'edit' => Pages\EditUniverse::route('/{record}/edit'),
        ];
    }    
}

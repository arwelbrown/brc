<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PublisherResource\Pages;
use App\Filament\Resources\PublisherResource\RelationManagers;
use App\Filament\Resources\PublisherResource\RelationManagers\ProductsRelationManager;
use App\Models\Publisher;
use Faker\Core\File;
use Faker\Provider\Text;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PublisherResource extends Resource
{
    protected static ?string $model = Publisher::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('publisher_name')
                            ->autofocus()
                            ->maxLength(255)
                            ->required(),
                TextInput::make('publisher_email')
                            ->autofocus()
                            ->email()
                            ->maxLength(255)
                            ->required(),
                TextInput::make('primary_contact')
                            ->autofocus()
                            ->maxLength(255)
                            ->required(),
                FileUpload::make('logo')
                            ->autofocus()
                            ->nullable(),
                FileUpload::make('banner')
                            ->autofocus()
                            ->nullable(),
                TextInput::make('description')
                            ->autofocus()
                            ->nullable(),
            ]);
    }

    /**
     * @throws \Exception
     */
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('publisher_name')->searchable(),
                TextColumn::make('publisher_email'),
                TextColumn::make('primary_contact')
            ])
            ->filters([
                //
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make()
            ])
            ->bulkActions([
                //
            ]);
    }

    public static function getRelations(): array
    {
        return [
            ProductsRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPublishers::route('/'),
            'create' => Pages\CreatePublisher::route('/create'),
            'edit' => Pages\EditPublisher::route('/{record}/edit'),
        ];
    }
}

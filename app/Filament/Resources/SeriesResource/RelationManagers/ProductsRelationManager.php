<?php

namespace App\Filament\Resources\SeriesResource\RelationManagers;

use Exception;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Livewire\TemporaryUploadedFile;

class ProductsRelationManager extends RelationManager
{
    protected static string $relationship = 'products';

    protected static ?string $recordTitleAttribute = 'id';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('product_name')
                    ->required()
                    ->autofocus()
                    ->placeholder('New Book #0')
                    ->maxLength(255),
                TextInput::make('series')
                    ->required()
                    ->autofocus()
                    ->placeholder('New Series')
                    ->maxLength(255),
                TagsInput::make('tags')
                    ->autofocus()
                    ->placeholder('Series 1, Series 2...'),
                TextInput::make('ejunkie_link_digital')
                    ->required()
                    ->autofocus()
                    ->maxLength(255)
                    ->label('EJunkie Digital Link'),
                TextInput::make('ejunkie_link_physical')
                    ->nullable()
                    ->autofocus()
                    ->maxLength(255)
                    ->label('Ejunkie Physical Link'),
                Textarea::make('summary')
                    ->autofocus()
                    ->columnSpan(2)
                    ->required()
                    ->placeholder('Enter summary...')
                    ->maxLength(2000),
                TextInput::make('digital_price')
                    ->numeric()
                    ->autofocus()
                    ->required(),
                TextInput::make('physical_price')
                    ->numeric()
                    ->autofocus()
                    ->nullable(),
                FileUpload::make('img_string')
                    ->autofocus()
                    ->preserveFilenames()
                    ->getUploadedFileNameForStorageUsing(function(TemporaryUploadedFile $file): string {
                        return (string) str($file->getClientOriginalName())->prepend('');
                    })
                    ->acceptedFileTypes(['image/webp'])
                    ->directory('img')
                    ->label('Cover Image (webp format ONLY!)')
                    ->image()
                    ->required()
            ]);
    }

    /**
     * @throws Exception
     */
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('product_name'),
                TextColumn::make('digital_price')
                        ->money('usd', true)
                        ->label('Digital Price ($)'),
                TextColumn::make('physical_price')
                        ->placeholder('n/a')
                        ->money('usd', true)
                        ->label('Physical Price ($)')
            ])
            ->filters([
                //
            ])
            ->headerActions([
                CreateAction::make(),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                //
            ]);
    }
}

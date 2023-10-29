<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SeriesResource\Pages;
use App\Filament\Resources\SeriesResource\RelationManagers\ProductsRelationManager;
use App\Formatters\SlugFormatter;
use App\Models\Series;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Forms\Components\Section;

class SeriesResource extends Resource
{
    protected static ?string $model = Series::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Product Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Series Info')
                    ->schema([
                        TextInput::make('series_name')
                            ->reactive()
                            ->afterStateUpdated(fn (callable $set, $state) => ! empty($state) ? $set('series_slug', SlugFormatter::formatSlug($state)) : $set('series_slug', ''))
                            ->autofocus()
                            ->required()
                            ->maxLength(255),
                        TextInput::make('series_slug')
                            ->autofocus()
                            ->required()
                            ->disabled(),
                        TagsInput::make('creators')
                            ->autofocus(),
                        TagsInput::make('writers')
                            ->autofocus(),
                        TagsInput::make('artists')
                            ->autofocus(),
                        TagsInput::make('editors')
                            ->autofocus(),
                        TagsInput::make('colorists')
                            ->autofocus(),
                        TagsInput::make('letterers')
                            ->autofocus(),
                        Textarea::make('series_description')
                            ->autofocus()
                            ->columnSpanFull()
                            ->required()
                            ->maxLength(2000),
                        Select::make('universe_id')
                            ->relationship('universe', 'universe_name')
                            ->autofocus()
                            ->required(),
                    ])
                    ->columns(2),
                Section::make('Series Images')
                    ->schema([
                        FileUpload::make('series_banner')
                        ->columnSpan(2)
                        ->required()
                        ->autofocus()
                        ->downloadable()
                        ->previewable()
                        ->imageEditor(),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('series_name')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('series_slug'),
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
            ProductsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSeries::route('/'),
            'create' => Pages\CreateSeries::route('/create'),
            'edit' => Pages\EditSeries::route('/{record}/edit'),
        ];
    }
}

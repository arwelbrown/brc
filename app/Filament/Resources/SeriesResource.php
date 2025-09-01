<?php

namespace App\Filament\Resources;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Actions\EditAction;
use App\Filament\Resources\Series\Pages\ListSeries;
use App\Filament\Resources\Series\Pages\CreateSeries;
use App\Filament\Resources\Series\Pages\EditSeries;
use App\Filament\Resources\Series\RelationManagers\BooksRelationManager;
use App\Formatters\SlugFormatter;
use App\Models\Series;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\IconColumn;

class SeriesResource extends Resource
{
    protected static ?string $model = Series::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static string | \UnitEnum | null $navigationGroup = 'Book Management';

    public static function form(Schema $schema): Schema
    {
        return $schema->components(
            [
                Section::make('Series Info')->schema(
                    [
                        TextInput::make('series_name')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(
                                fn (Set $set, ?string $state) => !empty($state) ? $set('series_slug', SlugFormatter::formatSlug($state)) : $set('series_slug', '')
                            ),
                        TextInput::make('series_slug')
                            ->required()
                            ->disabled(),
                        Select::make('canon_id')
                            ->relationship('canon', 'name'),
                        TagsInput::make('creators'),
                        TagsInput::make('writers'),
                        TagsInput::make('artists'),
                        TagsInput::make('editors'),
                        TagsInput::make('colorists'),
                        TagsInput::make('letterers'),
                        Textarea::make('series_description')
                            ->columnSpanFull()
                            ->required()
                            ->maxLength(2000),
                        Toggle::make('brc_series')
                            ->label('BRC Series')
                            ->inline()
                    ]
                )->columns(2),
                Section::make('Series Images')->schema(
                    [
                        FileUpload::make('series_banner')
                            ->columnSpan(2)
                            ->required()
                            ->default('')
                            ->directory('public/img')
                            ->getUploadedFileNameForStorageUsing(
                                function (Get $get, TemporaryUploadedFile $file): string {
                                    return 'series_' . $get('series_slug') . '/' . $file->getClientOriginalName();
                                }
                            )
                            ->downloadable()
                    ]
                )
            ]
        );
    }

    public static function table(Table $table): Table
    {
        return $table->columns(
            [
                TextColumn::make('series_name')
                    ->label('Series Name')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('series_slug')
                    ->label('Series Slug'),
                IconColumn::make('brc_series')
                    ->label('BRC Series')
                    ->boolean()
              ]
        )->filters(
            [
                //
            ]
        )->recordActions(
            [
                EditAction::make(),
            ]
        )->toolbarActions(
            [
                //
            ]
        );
    }

    public static function getRelations(): array
    {
        return [
            BooksRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListSeries::route('/'),
            'create' => CreateSeries::route('/create'),
            'edit' => EditSeries::route('/{record}/edit'),
        ];
    }
}

<?php

namespace App\Filament\Resources\Canons\RelationManagers;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Actions\CreateAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Components\Utilities\Get;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use App\Formatters\SlugFormatter;

class SeriesRelationManager extends RelationManager
{
    protected static string $relationship = 'series';

    protected static ?string $recordTitleAttribute = 'id';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components(
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

    public function table(Table $table): Table
    {
        return $table
            ->columns(
                [
                    TextColumn::make('series_name')
                        ->label('Series Name'),
                    TextColumn::make('series_slug')
                        ->label('Series Slug')
                ]
            )
            ->filters(
                [
                    //
                ]
            )
            ->headerActions(
                [
                    CreateAction::make(),
                ]
            )
            ->recordActions(
                [
                    EditAction::make(),
                ]
            )
            ->toolbarActions(
                [
                    //
                ]
            );
    }
}

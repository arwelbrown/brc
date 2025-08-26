<?php

namespace App\Filament\Resources\Series\RelationManagers;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Actions\CreateAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Exception;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use App\Http\Controllers\SeriesController;
use App\Formatters\SlugFormatter;
use Filament\Forms\Components\Toggle;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class BooksRelationManager extends RelationManager
{
    protected static string $relationship = 'books';

    protected static ?string $recordTitleAttribute = 'id';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Books Info')
                ->schema([
                    TextInput::make('name')
		    	->label('Book Name')
                        ->required()
                        ->placeholder('New Book #0')
                        ->maxLength(255)
                        ->columnSpan(2),
                    Select::make('series_id')
                        ->relationship('series', 'series_name')
                        ->live()
                        ->afterStateUpdated(
                            fn (Set $set, ?string $state) => !empty($state) ? $set('store_slug', SlugFormatter::formatSlug(SeriesController::getSeries($state)->series_name)) : $set('store_slug', ''))
                        ->required()
                        ->createOptionForm([
                            Section::make()
                                ->schema([
                                    TextInput::make('series.series_name')
                                        ->live(onBlur: true)
					->afterStateUpdated(
						fn (Set $set, ?string $state) => !empty($state) ? $set('series.series_slug', SlugFormatter::formatSlug($state)) : $set('series.series_slug', '')
					)
                                        ->required()
                                        ->maxLength(255),
                                    TextInput::make('series.series_slug')
                                        ->required()
                                        ->disabled(),
                                    TagsInput::make('series.creators'),
                                    TagsInput::make('series.writers'),
                                    TagsInput::make('series.artists'),
                                    TagsInput::make('series.editors'),
                                    TagsInput::make('series.colorists'),
                                    TagsInput::make('series.letterers'),
                                    Select::make('universe_id')
                                        ->relationship('universe', 'universe_name')
                                        ->required(),
                                    Textarea::make('series.series_description')
                                        ->columnSpanFull()
                                        ->required()
                                        ->maxLength(2000),
                                    FileUpload::make('series.series_banner')
                                        ->columnSpan(2),
                                ])
                                ->columns(2)
                            
                        ]),
                    TextInput::make('store_slug')
                        ->disabled()
                        ->hidden(),
                    TagsInput::make('tags')
                        ->placeholder('Series 1, Series 2...')
                        ->separator()
                        ->columnSpan(1),
                    TextInput::make('ejunkie_link_digital')
                        ->required()
                        ->maxLength(255)
                        ->label('EJunkie Digital Link')
                        ->columnSpan(2)
                        ->url(),
                    TextInput::make('ejunkie_link_physical')
                        ->reactive()
                        ->afterStateUpdated(
                            fn (?string $state, Set $set) => ! empty($state) ? $set('physical_available', true) : $set('physical_available', false)
                        )
                        ->nullable()
                        ->maxLength(255)
                        ->label('Ejunkie Physical Link')
                        ->url()
                        ->columnSpan(2)
                        ->required(fn (Get $get) => ! empty($get('physical_price')) ? true : false),
                    Textarea::make('summary')
                        ->columnSpan(2)
                        ->required()
                        ->placeholder('Enter summary...')
                        ->maxLength(2000),
                    TextInput::make('digital_price')
                        ->numeric()
                        ->required()
                        ->columnSpan(1),
                    TextInput::make('physical_price')
                        ->reactive()
                        ->numeric()
                        ->nullable()
                        ->columnSpan(1)
                        ->required(fn (Get $get) => ! empty($get('ejunkie_link_physical')) ? true : false),
                    FileUpload::make('img_string')
                        ->columnSpan(2)
                        ->label('Cover Image')
                        ->directory('/img')
                        ->getUploadedFileNameForStorageUsing(function (Get $get, TemporaryUploadedFile $file): string {
                            $seriesId = $get('series_id');
                            $series = SeriesController::getSeries($seriesId)->series_name;
    
                            return 'series_' . strtolower(str_replace(' ', '', $series)) . '/covers/' . $file->getClientOriginalName();
                        })
                        ->imageEditor()
                        ->downloadable()
                        ->previewable()
                        ->required(),
                ])
                ->columns(2),
                Section::make('Product Operations')
                    ->schema([
                        Toggle::make('in_development')
                            ->columnSpan(1)
                            ->default(false),
                        Toggle::make('physical_available')
                            ->columnSpan(1)
                            ->default(false),
                        Toggle::make('featured_product')
                            ->columnSpan(1)
                            ->default(false),
                        Toggle::make('active')
                            ->onIcon('heroicon-o-bolt')
                            ->columnSpan(1)
                            ->default(false),
                    ])
                    ->columns(3)
            ]);
    }

    /**
     * @throws Exception
     */
    public function table(Table $table): Table
    {
        return $table
            ->columns([
		TextColumn::make('name')
		    	->label('Book Name'),
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
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                //
            ]);
    }
}

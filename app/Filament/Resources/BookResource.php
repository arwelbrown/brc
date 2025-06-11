<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BookResource\Pages;
use App\Formatters\SlugFormatter;
use App\Http\Controllers\SeriesController;
use App\Models\Book;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Filament\Forms\Components\Section;
use Filament\Forms\Get;
use Filament\Forms\Set;

class BookResource extends Resource
{
    protected static ?string $model = Book::class;
    protected static ?string $navigationIcon = 'heroicon-s-book-open';
    protected static ?string $navigationGroup = 'Book Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Book Info')
                    ->schema([
                        TextInput::make('product_name')
                            ->required()
                            ->autofocus()
                            ->placeholder('New Book #0')
                            ->maxLength(255)
                            ->columnSpan(2),
                        Select::make('series_id')
                            ->relationship('series', 'series_name')
                            ->live()
                            ->afterStateUpdated(
                                fn(Set $set, ?string $state) => !empty($state) ? $set('store_slug', SlugFormatter::formatSlug(SeriesController::getSeries($state)->series_name)) : $set('store_slug', '')
                            )
                            ->required()
                            ->autofocus()
                            ->createOptionForm([
                                Section::make()
                                    ->schema([
                                        TextInput::make('series.series_name')
                                            ->live(onBlur: true)
                                            ->afterStateUpdated(fn(Set $set, ?string $state) => !empty($state) ? $set('series.series_slug', SlugFormatter::formatSlug($state)) : $set('series.series_slug', ''))
                                            ->autofocus()
                                            ->required()
                                            ->maxLength(255),
                                        TextInput::make('series.series_slug')
                                            ->autofocus()
                                            ->required()
                                            ->disabled(),
                                        TagsInput::make('series.creators')
                                            ->autofocus(),
                                        TagsInput::make('series.writers')
                                            ->autofocus(),
                                        TagsInput::make('series.artists')
                                            ->autofocus(),
                                        TagsInput::make('series.editors')
                                            ->autofocus(),
                                        TagsInput::make('series.colorists')
                                            ->autofocus(),
                                        TagsInput::make('series.letterers')
                                            ->autofocus(),
                                        Select::make('universe_id')
                                            ->relationship('universe', 'universe_name')
                                            ->autofocus()
                                            ->required(),
                                        Textarea::make('series.series_description')
                                            ->autofocus()
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
                            ->autofocus()
                            ->placeholder('Series 1, Series 2...')
                            ->separator()
                            ->columnSpan(1),
                        TextInput::make('ejunkie_link_digital')
                            ->required()
                            ->autofocus()
                            ->maxLength(255)
                            ->label('EJunkie Digital Link')
                            ->columnSpan(2)
                            ->url(),
                        TextInput::make('ejunkie_link_physical')
                            ->live()
                            ->afterStateUpdated(
                                fn(?string $state, Set $set) => !empty($state) ? $set('physical_available', true) : $set('physical_available', false)
                            )
                            ->nullable()
                            ->autofocus()
                            ->maxLength(255)
                            ->label('Ejunkie Physical Link')
                            ->url()
                            ->columnSpan(2)
                            ->required(fn(Get $get) => !empty($get('physical_price')) ? true : false),
                        Textarea::make('summary')
                            ->autofocus()
                            ->columnSpan(2)
                            ->required()
                            ->placeholder('Enter summary...')
                            ->maxLength(2000),
                        TextInput::make('digital_price')
                            ->numeric()
                            ->autofocus()
                            ->required()
                            ->columnSpan(1),
                        TextInput::make('physical_price')
                            ->reactive()
                            ->numeric()
                            ->autofocus()
                            ->nullable()
                            ->columnSpan(1)
                            ->required(fn(Get $get) => !empty($get('ejunkie_link_physical')) ? true : false),
                        FileUpload::make('img_string')
                            ->autofocus()
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
                Section::make('Book Operations')
                    ->schema([
                        Toggle::make('in_development')
                            ->autofocus()
                            ->columnSpan(1)
                            ->default(false),
                        Toggle::make('physical_available')
                            ->autofocus()
                            ->columnSpan(1)
                            ->default(false),
                        Toggle::make('featured_product')
                            ->autofocus()
                            ->columnSpan(1)
                            ->default(false),
                        Toggle::make('active')
                            ->onIcon('heroicon-o-bolt')
                            ->autofocus()
                            ->columnSpan(1)
                            ->default(false),
                        TextInput::make('stock')
                            ->numeric(),
                    ])
                    ->columns(3)
            ])
            ->columns(2);
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
                TextColumn::make('digital_price')
                    ->money('usd', true)
                    ->label('Digital Price ($)'),
                TextColumn::make('physical_price')
                    ->money('usd', true)
                    ->label('Physical Price ($)')
                    ->placeholder('n/a'),
                IconColumn::make('active')
                    ->boolean(),
                IconColumn::make('featured_product')
                    ->boolean(),
                IconColumn::make('in_development')
                    ->boolean()
                    ->label('In Development'),
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBooks::route('/'),
            'create' => Pages\CreateBook::route('/create'),
            'edit' => Pages\EditBook::route('/{record}/edit'),
        ];
    }

    public static function shouldRegisterNavigation(): bool
    {
        return auth()->user()->hasRole('admin');
    }
}

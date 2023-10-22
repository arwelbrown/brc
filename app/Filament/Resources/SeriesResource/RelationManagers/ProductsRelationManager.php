<?php

namespace App\Filament\Resources\SeriesResource\RelationManagers;

use Exception;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use App\Http\Controllers\SeriesController;
use Livewire\TemporaryUploadedFile;
use App\Formatters\SlugFormatter;
use Filament\Forms\Components\Toggle;

class ProductsRelationManager extends RelationManager
{
    protected static string $relationship = 'products';

    protected static ?string $recordTitleAttribute = 'id';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('product_name')
                    ->required()
                    ->autofocus()
                    ->placeholder('New Book #0')
                    ->maxLength(255)
                    ->columnSpan('full'),
                Select::make('series_id')
                    ->relationship('series', 'series_name')
                    ->reactive()
                    ->afterStateUpdated(
                        fn ($state, callable $set) => $set('store_slug', SlugFormatter::formatSlug(SeriesController::getSeries($state)->series_name)))
                    ->required()
                    ->autofocus()
                    ->createOptionForm([
                        TextInput::make('series.series_name')
                        ->reactive()
                        ->afterStateUpdated(fn (callable $set, $state) => !empty($state) ? $set('series.series_slug', SlugFormatter::formatSlug($state)) : $set('series.series_slug', ''))
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
                        FileUpload::make('series.series_banner'),
                    ]),
                TextInput::make('store_slug')
                    ->prefix('store-')
                    ->disabled(),
                TagsInput::make('tags')
                    ->autofocus()
                    ->placeholder('Series 1, Series 2...')
                    ->separator()
                    ->columnSpan(2),
                TextInput::make('ejunkie_link_digital')
                    ->required()
                    ->autofocus()
                    ->maxLength(255)
                    ->label('EJunkie Digital Link'),
                TextInput::make('ejunkie_link_physical')
                    ->reactive()
                    ->afterStateUpdated(
                        fn ($state, callable $set) => !empty($state) ? $set('physical_available', true) : $set('physical_available', false)
                    )
                    ->nullable()
                    ->autofocus()
                    ->maxLength(255)
                    ->label('Ejunkie Physical Link')
                    ->required(fn ($state, callable $get) => !empty($get('physical_price')) ? true : false),
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
                    ->reactive()
                    ->numeric()
                    ->autofocus()
                    ->nullable()
                    ->required(fn ($state, callable $get) => !empty($get('ejunkie_link_physical')) ? true : false),
                FileUpload::make('img_string')
                    ->reactive()
                    ->autofocus()
                    ->preserveFilenames()
                    ->acceptedFileTypes(['image/webp'])
                    ->columnSpan(2)
                    ->label('Cover Image')
                    ->image()
                    ->directory('/img')
                    ->getUploadedFileNameForStorageUsing(function (callable $get, TemporaryUploadedFile $file): string {
                        $seriesId = $get('series_id');
                        $series = SeriesController::getSeries($seriesId)->series_name;
                        return 'series_' . strtolower(str_replace(' ', '', $series)) . '/covers/' . $file->getClientOriginalName();
                    })
                    ->enableOpen()
                    ->enableDownload()
                    ->required(),
                Toggle::make('in_development')
                    ->autofocus()
                    ->default(false),
                Toggle::make('physical_available')
                    ->autofocus()
                    ->default(false),
                Toggle::make('active')
                    ->onIcon('heroicon-m-bolt')
                    ->autofocus()
                    ->default(false),
            ]);
    }

    /**
     * @throws Exception
     */
    public function table(Table $table): Table
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

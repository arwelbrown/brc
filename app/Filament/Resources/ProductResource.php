<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use App\Models\Publisher;
use Exception;
use Closure;
use Faker\Core\File;
use Filament\Forms;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Actions\DeleteAction;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\Layout;
use Filament\Tables\Filters\SelectFilter;
use FilesystemIterator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Livewire\TemporaryUploadedFile;
use Illuminate\Support\Str;
use App\Http\Controllers\SeriesController;
use App\Formatters\SlugFormatter;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-s-book-open';
    protected static ?string $navigationGroup = 'Product Management';


    public static function form(Form $form): Form
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
                                                ->autofocus()
                                                ->reactive()
                                                ->afterStateUpdated(fn (callable $get, callable $set) => $set('series.series_slug', SlugFormatter::formatSlug($get('series.series_name'))))
                                                ->required()
                                                ->maxLength(255),
                                    Textarea::make('series.series_description')
                                                ->autofocus()
                                                ->required()
                                                ->maxLength(2000),
                                    TextInput::make('series.series_slug')
                                                ->autofocus()
                                                ->required()
                                                ->disabled(),
                                    Select::make('publisher')
                                                ->relationship('publisher', 'publisher_name')
                                                ->required(),
                                    FileUpload::make('series_banner'),
                                    FileUpload::make('series_logo')
                                ]),
                TextInput::make('store_slug')
                                ->prefix('store-')
                                ->disabled(),
                TagsInput::make('tags')
                                ->autofocus()
                                ->placeholder('Series 1, Series 2...')
                                ->separator(),
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
                Select::make('publisher_id')
                                ->relationship('publisher', 'publisher_name')
                                ->autofocus()
                                ->preload()
                                ->createOptionForm([
                                    TextInput::make('publisher.publisher_name')
                                                    ->autofocus()
                                                    ->required()
                                                    ->maxLength(255),
                                    TextInput::make('publisher.publisher_email')
                                                    ->email()
                                                    ->autofocus()
                                                    ->maxLength(255)
                                                    ->required(),
                                    FileUpload::make('publisher.logo')
                                                    ->autofocus()
                                                    ->preserveFilenames()
                                                    ->nullable(),
                                    TextInput::make('publisher.description')
                                                    ->autofocus()
                                                    ->maxLength(2000)
                                                    ->nullable(),
                                    FileUpload::make('publisher.banner')
                                                    ->autofocus()
                                                    ->preserveFilenames()
                                                    ->nullable()
                                ])
                                ->required(),
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
                            ->autofocus()
                            ->preserveFilenames()
                            ->acceptedFileTypes(['image/webp'])
                            ->columnSpan(2)
                            ->label('Cover Image')
                            ->image()
                            ->directory('/img')
                            ->getUploadedFileNameForStorageUsing(function (TemporaryUploadedFile $file): string {
                                $explode = explode('%', $file->getClientOriginalName());
                                $series = strtolower($explode[0]);
                                $coverTitle = $explode[1];

                                return 'series_' . $series . '/covers/' . $coverTitle;
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
                            ->onIcon('heroicon-s-lightning-bolt')
                            ->autofocus()
                            ->default(false),
            ]);
    }

    /**
     * @throws Exception
     */

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('product_name')
                            ->sortable()
                            ->searchable(),
                TextColumn::make('publisher.publisher_name')
                            ->searchable()
                            ->sortable(),
                TextColumn::make('digital_price')
                            ->money('usd', true)
                            ->label('Digital Price ($)'),
                TextColumn::make('physical_price')
                            ->money('usd', true)
                            ->label('Physical Price ($)')
                            ->placeholder('n/a')

            ])
            ->defaultSort('product_name')
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit')
        ];
    }
}

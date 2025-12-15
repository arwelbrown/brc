<?php

namespace App\Filament\Resources;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Actions\EditAction;
use App\Filament\Resources\Books\Pages\ListBooks;
use App\Filament\Resources\Books\Pages\CreateBook;
use App\Filament\Resources\Books\Pages\EditBook;
use App\Filament\Resources\Books\Pages;
use App\Formatters\SlugFormatter;
use App\Http\Controllers\SeriesController;
use App\Models\Book;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class BookResource extends Resource
{
    protected static ?string $model = Book::class;
    protected static string|\BackedEnum|null $navigationIcon = "heroicon-s-book-open";
    protected static string|\UnitEnum|null $navigationGroup = "Book Management";

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make("Book Info")
                    ->schema([
                        TextInput::make("name")
                            ->label("Book name")
                            ->required()
                            ->placeholder("New Book #0")
                            ->maxLength(255)
                            ->columnSpan(2),
                        Select::make("series_id")
                            ->relationship("series", "series_name")
                            ->live()
                            ->afterStateUpdated(
                                fn(Set $set, ?string $state) => !empty($state)
                                    ? $set(
                                        "store_slug",
                                        SlugFormatter::formatSlug(
                                            SeriesController::getSeries($state)
                                                ->series_name,
                                        ),
                                    )
                                    : $set("store_slug", ""),
                            )
                            ->required()
                            ->createOptionForm([
                                Section::make()
                                    ->schema([
                                        TextInput::make("series.series_name")
                                            ->live(onBlur: true)
                                            ->afterStateUpdated(
                                                fn(
                                                    Set $set,
                                                    ?string $state,
                                                ) => !empty($state)
                                                    ? $set(
                                                        "series.series_slug",
                                                        SlugFormatter::formatSlug(
                                                            $state,
                                                        ),
                                                    )
                                                    : $set(
                                                        "series.series_slug",
                                                        "",
                                                    ),
                                            )
                                            ->required()
                                            ->maxLength(255),
                                        TextInput::make("series.series_slug")
                                            ->required()
                                            ->disabled(),
                                        TagsInput::make("series.creators"),
                                        TagsInput::make("series.writers"),
                                        TagsInput::make("series.artists"),
                                        TagsInput::make("series.editors"),
                                        TagsInput::make("series.colorists"),
                                        TagsInput::make("series.letterers"),
                                        Select::make("universe_id")
                                            ->relationship(
                                                "univhttp://localhost/public/img/series_theemeraldcoyote/covers/EC_1_Cover.webperse",
                                                "universe_name",
                                            )
                                            ->required(),
                                        Textarea::make(
                                            "series.series_description",
                                        )
                                            ->columnSpanFull()
                                            ->required()
                                            ->maxLength(2000),
                                        FileUpload::make(
                                            "series.series_banner",
                                        )->columnSpan(2),
                                    ])
                                    ->columns(2),
                            ]),
                        TextInput::make("store_slug")->disabled()->hidden(),
                        TagsInput::make("tags")
                            ->placeholder("Series 1, Series 2...")
                            ->separator()
                            ->columnSpan(1),
                        TextInput::make("ejunkie_link_digital")
                            ->required()
                            ->maxLength(255)
                            ->label("EJunkie Digital Link")
                            ->columnSpan(2)
                            ->url(),
                        TextInput::make("ejunkie_link_physical")
                            ->live()
                            ->afterStateUpdated(
                                fn(?string $state, Set $set) => !empty($state)
                                    ? $set("physical_available", true)
                                    : $set("physical_available", false),
                            )
                            ->nullable()
                            ->maxLength(255)
                            ->label("Ejunkie Physical Link")
                            ->url()
                            ->columnSpan(2)
                            ->required(
                                fn(Get $get) => !empty($get("physical_price"))
                                    ? true
                                    : false,
                            ),
                        Textarea::make("summary")
                            ->columnSpan(2)
                            ->required()
                            ->placeholder("Enter summary...")
                            ->maxLength(2000),
                        TextInput::make("digital_price")
                            ->numeric()
                            ->required()
                            ->columnSpan(1),
                        TextInput::make("physical_price")
                            ->reactive()
                            ->numeric()
                            ->nullable()
                            ->columnSpan(1)
                            ->default(0)
                            ->required(
                                fn(Get $get) => !empty(
                                    $get("ejunkie_link_physical")
                                )
                                    ? true
                                    : false,
                            ),
                        FileUpload::make("img_string")
                            ->image()
                            ->imageEditor()
                            ->columnSpan(2)
                            ->label("Cover Image")
                            ->directory("img")
                            ->getUploadedFileNameForStorageUsing(function (
                                Get $get,
                                TemporaryUploadedFile $file,
                            ): string {
                                $seriesId = $get("series_id");
                                $series = SeriesController::getSeries($seriesId)
                                    ->series_name;

                                return "series_" .
                                    strtolower(str_replace(" ", "", $series)) .
                                    "/covers/" .
                                    $file->getClientOriginalName();
                            })
                            ->required(),
                    ])
                    ->columns(2),
                Section::make("Book Operations")
                    ->schema([
                        Toggle::make("in_development")
                            ->inline()
                            ->default(false),
                        Toggle::make("physical_available")
                            ->inline()
                            ->default(false),
                        Toggle::make("featured_product")
                            ->inline()
                            ->default(false),
                        Toggle::make("active")
                            ->inline()
                            ->onIcon("heroicon-o-bolt")
                            ->default(false),
                        TextInput::make("stock")->default(0)->numeric(),
                    ])
                    ->columns(3),
            ])
            ->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make("name")
                    ->label("Book name")
                    ->searchable()
                    ->sortable(),
                TextColumn::make("series.series_name")
                    ->searchable()
                    ->sortable(),
                TextColumn::make("digital_price")
                    ->money("usd", true)
                    ->label('Digital Price ($)'),
                TextColumn::make("physical_price")
                    ->money("usd", true)
                    ->label('Physical Price ($)')
                    ->placeholder("n/a"),
                IconColumn::make("active")->boolean(),
                IconColumn::make("featured_product")->boolean(),
                IconColumn::make("in_development")
                    ->boolean()
                    ->label("In Development"),
            ])
            ->filters([
                //
            ])
            ->recordActions([EditAction::make()])
            ->toolbarActions([
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
            "index" => ListBooks::route("/"),
            "create" => CreateBook::route("/create"),
            "edit" => EditBook::route("/{record}/edit"),
        ];
    }

    public static function shouldRegisterNavigation(): bool
    {
        return auth()
            ->user()
            ->hasRole(["admin", "super-admin"]);
    }
}

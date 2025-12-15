<?php

namespace App\Filament\Resources;

use App\Filament\Resources\Canons\RelationManagers\SeriesRelationManager;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Actions\EditAction;
use App\Filament\Resources\Canons\Pages\ListCanons;
use App\Filament\Resources\Canons\Pages\CreateCanon;
use App\Filament\Resources\Canons\Pages\EditCanon;
use App\Models\Canon;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Table;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class CanonResource extends Resource
{
    protected static ?string $model = Canon::class;

    protected static string|\BackedEnum|null $navigationIcon = "heroicon-o-globe-alt";

    protected static string|\UnitEnum|null $navigationGroup = "Book Management";

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Section::make("Canon Info")->schema([
                TextInput::make("name")
                    ->label("Canon Name")
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(
                        fn(Set $set, ?string $state) => !empty($state)
                            ? $set(
                                "slug",
                                strtolower(str_replace(" ", "-", $state)),
                            )
                            : $set("series_slug", ""),
                    )
                    ->maxLength(100),
                TextInput::make("slug")->readOnly(),
                FileUpload::make("img_string")
                    ->label("Image")
                    ->columnSpan(2)
                    ->required()
                    ->default("")
                    ->directory("img")
                    ->getUploadedFileNameForStorageUsing(
                        fn(TemporaryUploadedFile $file): string => "canons" .
                            "/" .
                            $file->getClientOriginalName(),
                    )
                    ->downloadable(),
                FileUpload::make("bg_img_string")
                    ->label("Background Image")
                    ->columnSpan(2)
                    ->directory("img")
                    ->getUploadedFileNameForStorageUsing(
                        fn(TemporaryUploadedFile $file): string => "canons" .
                            "/" .
                            $file->getClientOriginalName(),
                    ),
                Toggle::make("active"),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make("name")
                    ->label("Canon Name")
                    ->sortable()
                    ->searchable(),
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
        return [SeriesRelationManager::class];
    }

    public static function getPages(): array
    {
        return [
            "index" => ListCanons::route("/"),
            "create" => CreateCanon::route("/create"),
            "edit" => EditCanon::route("/{record}/edit"),
        ];
    }
}

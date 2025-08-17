<?php

namespace App\Filament\Resources;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Actions\EditAction;
use App\Filament\Resources\CharacterResource\Pages\ListCharacters;
use App\Filament\Resources\CharacterResource\Pages\CreateCharacter;
use App\Filament\Resources\CharacterResource\Pages\EditCharacter;
use App\Filament\Resources\CharacterResource\Pages;
use App\Filament\Resources\CharacterResource\RelationManagers\SeriesRelationManager;
use App\Http\Controllers\SeriesController;
use App\Models\Character;
use App\Models\Series;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class CharacterResource extends Resource
{
    protected static ?string $model = Character::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-s-user';

    protected static string | \UnitEnum | null $navigationGroup = 'Wiki';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Character Info')
                    ->schema([
                        TextInput::make('name')
                            ->autofocus()
                            ->required()
                            ->placeholder('Enter here...'),
                        Select::make('series_id')
                            ->relationship('series', 'series_name')
                            ->required()
                            ->autofocus(),
                        TextInput::make('real_name')
                            ->autofocus()
                            ->placeholder('Enter here...'),
                        TextInput::make('race')
                            ->autofocus()
                            ->required()
                            ->placeholder('Adaptable X-Tier...'),
                        TagsInput::make('aliases')
                            ->autofocus(),
                        TagsInput::make('abilities')
                            ->autofocus(),
                        TagsInput::make('weaknesses')
                            ->autofocus(),
                        TagsInput::make('affiliations')
                            ->autofocus(),
                        Select::make('appearances')
                            ->multiple()
                            ->getSearchResultsUsing(fn (string $search): array => Series::where('series_name', 'like', "%{$search}%")->limit(50)->pluck('series_name', 'id')->toArray())
                            ->getOptionLabelsUsing(fn (array $values): array => Series::whereIn('id', $values)->pluck('series_name', 'id')->toArray())
                            ->preload(),
                        Textarea::make('history')
                            ->autofocus()
                            ->columnspan(2),
                    ])
                    ->columns(2),
                    Section::make('Character Images')
                        ->schema([
                            FileUpload::make('img_string')
                                ->reactive()
                                ->preserveFilenames()
                                ->acceptedFileTypes(['image/webp'])
                                ->autofocus()
                                ->required()
                                ->label('Character art')
                                ->directory('/img')
                                ->columnspan(2)
                                ->openable()
                                ->downloadable()
                                ->getUploadedFileNameForStorageUsing(function (callable $get, TemporaryUploadedFile $file): string {
                                    $seriesId = $get('series_id');
                                    $series = SeriesController::getSeries($seriesId)->series_name;

                                    return 'series_'.strtolower(str_replace(' ', '', $series)).'/characters/'.$file->getClientOriginalName();
                                }),
                            ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('series.series_name')
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                //
            ]);
    }

    public static function getRelations(): array
    {
        return [
            SeriesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListCharacters::route('/'),
            'create' => CreateCharacter::route('/create'),
            'edit' => EditCharacter::route('/{record}/edit'),
        ];
    }
}

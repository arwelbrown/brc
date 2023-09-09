<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CharacterResource\Pages;
use App\Models\Character;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TagsInput;
use App\Filament\Resources\CharacterResource\RelationManagers\SeriesRelationManager;
use App\Http\Controllers\SeriesController;
use Filament\Forms\Components\Select;
use Livewire\TemporaryUploadedFile;
use Filament\Tables\Actions\EditAction;
use App\Models\Series;

class CharacterResource extends Resource
{
    protected static ?string $model = Character::class;

    protected static ?string $navigationIcon = 'heroicon-s-user';
    protected static ?string $navigationGroup = 'Wiki';


    public static function form(Form $form): Form
    {
        return $form
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
                    ->required()
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
                    ->autofocus()
                    ->required()
                    ->preload(),
                FileUpload::make('img_string')
                    ->reactive()
                    ->preserveFilenames()
                    ->acceptedFileTypes(['image/webp'])
                    ->autofocus()
                    ->required()
                    ->label('Character art')
                    ->directory('/img')
                    ->columnspan(2)
                    ->enableOpen()
                    ->enableDownload()
                    ->getUploadedFileNameForStorageUsing(function (callable $get, TemporaryUploadedFile $file): string {
                        $seriesId = $get('series_id');
                        $series = SeriesController::getSeries($seriesId)->series_name;

                        return 'series_' . strtolower(str_replace(' ', '', $series)) . '/characters/' . $file->getClientOriginalName();
                    })
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
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
            SeriesRelationManager::class,
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCharacters::route('/'),
            'create' => Pages\CreateCharacter::route('/create'),
            'edit' => Pages\EditCharacter::route('/{record}/edit'),
        ];
    }    
}

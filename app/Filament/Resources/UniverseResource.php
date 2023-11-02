<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UniverseResource\Pages;
use App\Filament\Resources\UniverseResource\RelationManagers\SeriesRelationManager;
use App\Formatters\SlugFormatter;
use App\Models\Universe;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class UniverseResource extends Resource
{
    protected static ?string $model = Universe::class;

    protected static ?string $navigationGroup = 'Wiki';

    protected static ?string $navigationIcon = 'heroicon-o-globe-alt';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Universe Info')
                    ->schema([
                        TextInput::make('universe_name')
                            ->autofocus()
                            ->required()
                            ->live()
                            ->columnSpan(1)
                            ->afterStateUpdated(
                                fn (Set $set, ?string $state) => !empty($state) ? $set('universe_slug', SlugFormatter::formatSlug($state)) : $set('universe_slug', '')
                            )
                            ->debounce(1200),
                        TextInput::make('universe_slug')
                            ->disabled()
                            ->autofocus()
                            ->required()
                            ->columnSpan(1),
                        Textarea::make('universe_summary')
                            ->columnSpanFull(),
                        Textarea::make('universe_description')
                            ->columnSpanFull(),
                    ])
                ->columns(2),
                Section::make('Universe Images')
                    ->schema([
                        FileUpload::make('universe_banner_img_string')
                            ->autofocus()
                            ->preserveFilenames()
                            ->columnSpan(2)
                            ->label('Banner Image')
                            ->directory('/img')
                            ->getUploadedFileNameForStorageUsing(function (callable $get, TemporaryUploadedFile $file): string {
                                return 'universe_' . $get('universe_slug') . '/' . $file->getClientOriginalName();
                            })
                            ->downloadable()
                            ->required()
                            ->columnSpan(1)
                            ->imageEditor(),
                        FileUpload::make('universe_background_img_string')
                            ->autofocus()
                            ->preserveFilenames()
                            ->columnSpan(2)
                            ->label('Background Image')
                            ->directory('/img')
                            ->getUploadedFileNameForStorageUsing(function (callable $get, TemporaryUploadedFile $file): string {
                                return 'universe_' . $get('universe_slug') . '/' . $file->getClientOriginalName();
                            })
                            ->downloadable()
                            ->columnspan(1)
                            ->imageEditor(),
                        FileUpload::make('universe_logo_img_string')
                            ->autofocus()
                            ->preserveFilenames()
                            ->columnSpan(2)
                            ->label('Logo')
                            ->directory('/img')
                            ->getUploadedFileNameForStorageUsing(function (callable $get, TemporaryUploadedFile $file): string {
                                return 'universe_' . $get('universe_slug') . '/' . $file->getClientOriginalName();
                            })
                            ->downloadable()
                            ->columnspan(1)
                            ->imageEditor(),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('universe_name'),
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
            'index' => Pages\ListUniverses::route('/'),
            'create' => Pages\CreateUniverse::route('/create'),
            'edit' => Pages\EditUniverse::route('/{record}/edit'),
        ];
    }
}

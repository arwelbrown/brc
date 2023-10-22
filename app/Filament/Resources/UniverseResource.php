<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UniverseResource\Pages;
use App\Filament\Resources\UniverseResource\RelationManagers\SeriesRelationManager;
use App\Formatters\SlugFormatter;
use App\Models\Universe;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
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
                Card::make()
                    ->schema([
                        TextInput::make('universe_name')
                            ->autofocus()
                            ->required()
                            ->reactive()
                            ->columnSpan(1)
                            ->afterStateUpdated(fn (callable $set, $state) => ! empty($state) ? $set('universe_slug', SlugFormatter::formatSlug($state)) : $set('universe_slug', '')),
                        TextInput::make('universe_slug')
                            ->disabled()
                            ->autofocus()
                            ->required()
                            ->columnSpan(1)
                            ->reactive(),
                        FileUpload::make('universe_banner_img_string')
                            ->reactive()
                            ->autofocus()
                            ->preserveFilenames()
                            ->acceptedFileTypes(['image/webp'])
                            ->columnSpan(2)
                            ->label('Banner Image')
                            ->image()
                            ->directory('/img')
                            ->getUploadedFileNameForStorageUsing(function (callable $get, TemporaryUploadedFile $file): string {
                                return '/br_admin/universe_banners/'.$file->getClientOriginalName();
                            })
                            ->enableOpen()
                            ->enableDownload()
                            ->required()
                            ->columnSpan(1),
                        FileUpload::make('universe_background_img_string')
                            ->reactive()
                            ->autofocus()
                            ->preserveFilenames()
                            ->acceptedFileTypes(['image/webp'])
                            ->columnSpan(2)
                            ->label('Background Image')
                            ->image()
                            ->directory('/img')
                            ->getUploadedFileNameForStorageUsing(function (callable $get, TemporaryUploadedFile $file): string {
                                return '/universe_'.$get('universe_slug').'/'.$file->getClientOriginalName();
                            })
                            ->enableOpen()
                            ->enableDownload()
                            ->required()
                            ->columnspan(1),
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

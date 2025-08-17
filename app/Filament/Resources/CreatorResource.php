<?php

namespace App\Filament\Resources;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Actions\EditAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use App\Filament\Resources\CreatorResource\Pages\ListCreators;
use App\Filament\Resources\CreatorResource\Pages\CreateCreator;
use App\Filament\Resources\CreatorResource\Pages\EditCreator;
use App\Filament\Resources\CreatorResource\Pages;
use App\Models\Creator;
use App\Models\CreatorType;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use BRC\Config\CreatorTypes;

class CreatorResource extends Resource
{
    protected static ?string $model = Creator::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-paint-brush';
    protected static string | \UnitEnum | null $navigationGroup = 'Site Admin';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Creator Info')
                    ->schema([
                        TextInput::make('name')
                            ->autofocus()
                            ->required()
                            ->columnSpan(1),
                        Select::make('creator_type')
                            ->multiple()
                            ->options(CreatorTypes::get()),
                        Textarea::make('bio')
                            ->autofocus()
                            ->columnSpanFull(),
                        FileUpload::make('img_string')
                            ->reactive()
                            ->preserveFilenames()
                            ->acceptedFileTypes(['image/webp'])
                            ->autofocus()
                            ->required()
                            ->label('Creator Avatar')
                            ->directory('/img')
                            ->columnSpanFull()
                            ->openable()
                            ->downloadable()
                            ->getUploadedFileNameForStorageUsing(function (Get $get, TemporaryUploadedFile $file): string {
                                return '/creators/' . str_replace(' ' ,  '-', $get('name')) . '/' . $file->getClientOriginalName();
                            }),
                    ])
                    ->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('creator_type')
                    ->sortable()
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
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
            'index' => ListCreators::route('/'),
            'create' => CreateCreator::route('/create'),
            'edit' => EditCreator::route('/{record}/edit'),
        ];
    }
    
    public static function shouldRegisterNavigation(): bool
    {
        return auth()->user()->hasRole('admin');
    }
}   

<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CreatorResource\Pages;
use App\Models\Creator;
use App\Models\CreatorType;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Section;
use Filament\Forms\Get;
use Filament\Tables\Columns\TextColumn;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class CreatorResource extends Resource
{
    protected static ?string $model = Creator::class;

    protected static ?string $navigationIcon = 'heroicon-o-paint-brush';
    protected static ?string $navigationGroup = 'Site Admin';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Creator Info')
                    ->schema([
                        TextInput::make('name')
                            ->autofocus()
                            ->required()
                            ->columnSpan(1),
                        Select::make('creator_type')
                            ->multiple()
                            ->searchable()
                            ->getSearchResultsUsing(fn (string $search): array => CreatorType::where('type', 'like', "%{$search}%")->limit(50)->pluck('type', 'id')->toArray())
                            ->getOptionLabelsUsing(fn (array $values): array => CreatorType::whereIn('id', $values)->pluck('type', 'id')->toArray())
                            ->preload(),
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
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListCreators::route('/'),
            'create' => Pages\CreateCreator::route('/create'),
            'edit' => Pages\EditCreator::route('/{record}/edit'),
        ];
    }
    
    public static function shouldRegisterNavigation(): bool
    {
        return auth()->user()->hasRole('admin');
    }
}   

<?php

namespace App\Filament\Resources\UniverseResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\CreateAction;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Select;
use App\Formatters\SlugFormatter;
use Filament\Forms\Components\Section;
use Filament\Forms\Set;
use Filament\Forms\Get;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class SeriesRelationManager extends RelationManager
{
    protected static string $relationship = 'series';

    protected static ?string $recordTitleAttribute = 'id';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Series Info')
                    ->schema([
                        TextInput::make('series_name')
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn (Set $set, ?string $state) => !empty($state) ? $set('series_slug', SlugFormatter::formatSlug($state)) : $set('series_slug', ''))
                            ->autofocus()
                            ->required()
                            ->maxLength(255),
                        TextInput::make('series_slug')
                            ->autofocus()
                            ->required()
                            ->disabled(),
                        TagsInput::make('creators')
                            ->autofocus(),
                        TagsInput::make('writers')
                            ->autofocus(),
                        TagsInput::make('artists')
                            ->autofocus(),
                        TagsInput::make('editors')
                            ->autofocus(),
                        TagsInput::make('colorists')
                            ->autofocus(),
                        TagsInput::make('letterers')
                            ->autofocus(),
                        Textarea::make('series_description')
                            ->autofocus()
                            ->columnSpanFull()
                            ->required()
                            ->maxLength(2000),
                        Select::make('universe_id')
                            ->relationship('universe', 'universe_name')
                            ->autofocus()
                            ->required(),
                    ])
                    ->columns(2),
                Section::make('Series Images')
                    ->schema([
                        FileUpload::make('series_banner')
                        ->columnSpan(2)
                        ->required()
                        ->autofocus()
                        ->downloadable()
                        ->previewable()
                        ->imageEditor(),
                    ])
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('series_name'),
                TextColumn::make('series_slug'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                CreateAction::make(),
            ])
            ->actions([
                EditAction::make(),
            ])
            ->bulkActions([
                //
            ]);
    }    
}

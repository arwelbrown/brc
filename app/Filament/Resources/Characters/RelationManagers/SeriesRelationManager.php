<?php

namespace App\Filament\Resources\Characters\RelationManagers;

use Filament\Schemas\Schema;
use Filament\Actions\CreateAction;
use Filament\Actions\EditAction;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Select;
use App\Formatters\SlugFormatter;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;

class SeriesRelationManager extends RelationManager
{
    protected static string $relationship = 'series';
    protected static ?string $recordTitleAttribute = 'id';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('series_name')
                    ->reactive()
                    ->afterStateUpdated(fn (callable $set, $state) => !empty($state) ? $set('series_slug', SlugFormatter::formatSlug($state)) : $set('series_slug', ''))
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
                FileUpload::make('series_banner')
                  ->visibility('public'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('series_name'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                CreateAction::make(),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                //
            ]);
    }    
}

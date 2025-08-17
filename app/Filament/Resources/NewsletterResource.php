<?php

namespace App\Filament\Resources;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Support\Enums\Width;
use Filament\Actions\EditAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use App\Filament\Resources\Newsletters\Pages\ListNewsletters;
use App\Filament\Resources\Newsletters\Pages\CreateNewsletter;
use App\Filament\Resources\Newsletters\Pages\EditNewsletter;
use App\Filament\Resources\Newsletters\Pages;
use App\Models\Newsletter;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class NewsletterResource extends Resource
{
    protected static ?string $model = Newsletter::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-newspaper';

    protected static string | \UnitEnum | null $navigationGroup = 'Site Admin';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                    ->schema([
                        DateTimePicker::make('newsletter_timestamp')
                            ->label('Newsletter Timestamp')
                            ->seconds(false)
                            ->columnSpan(1),
                    ])
                    ->maxWidth(Width::Small),
                Section::make()
                    ->schema([
                        FileUpload::make('img_string')
                            ->reactive()
                            ->autofocus()
                            ->preserveFilenames()
                            ->label('Cover Image')
                            ->directory('newsletters/covers')
                            ->getUploadedFileNameForStorageUsing(function (TemporaryUploadedFile $file): string {
                                return $file->getClientOriginalName();                               
                            }),
                        FileUpload::make('file_path')
                            ->reactive()
                            ->autofocus()
                            ->preserveFilenames()
                            ->label('Upload PDF')
                            ->directory('newsletters')
                            ->getUploadedFileNameForStorageUsing(function (TemporaryUploadedFile $file): string {
                                return $file->getClientOriginalName();                               
                            }),
                        Toggle::make('active')
                            ->autofocus(),
                        Toggle::make('coming_soon')
                            ->autofocus(),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('newsletter_timestamp')
                    ->label('Newsletter For')
                    ->searchable()
                    ->sortable(),
                IconColumn::make('active')
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
            'index' => ListNewsletters::route('/'),
            'create' => CreateNewsletter::route('/create'),
            'edit' => EditNewsletter::route('/{record}/edit'),
        ];
    }
}

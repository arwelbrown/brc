<?php

namespace App\Filament\Resources;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Actions\EditAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use App\Filament\Resources\SubmissionResource\Pages\ListSubmissions;
use App\Filament\Resources\SubmissionResource\Pages\EditSubmission;
use App\Filament\Resources\SubmissionResource\Pages;
use App\Models\Submission;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\IconColumn;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class SubmissionResource extends Resource
{
    protected static ?string $model = Submission::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-inbox';
    protected static string | \UnitEnum | null $navigationGroup = 'Product Management';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                    ->schema([
                        TextInput::make('name')
                            ->autofocus(),
                        TextInput::make('email')
                            ->autofocus(),
                        DateTimePicker::make('created_at')
                            ->autofocus()
                            ->label('Uploaded At')
                            ->disabled(),
                        FileUpload::make('file_name')
                            ->autofocus()
                            ->directory('submissions')
                            ->getUploadedFileNameForStorageUsing(function (TemporaryUploadedFile $file): string {
                                return $file->getClientOriginalName();
                            })
                            ->columnSpanFull()
                            ->label('Uploaded File')
                            ->downloadable()
                            ->previewable(),
                        Toggle::make('approved'),
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
                TextColumn::make('email')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('created_at')->dateTime('d-M-Y'),
                IconColumn::make('approved')->boolean(),
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
            'index' => ListSubmissions::route('/'),
            'edit' => EditSubmission::route('/{record}/edit'),
        ];
    }    

    public static function shouldRegisterNavigation(): bool
    {
        if (auth()->user()->hasRole('admin')) {
            return true;
        }

        return false;
    }
}

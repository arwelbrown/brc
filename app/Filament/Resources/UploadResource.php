<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UploadResource\Pages;
use App\Filament\Resources\UploadResource\RelationManagers;
use App\Models\Upload;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use App\Enums\Uploads\UploadStatusEnum;
use Filament\Forms\Get;
use Filament\Tables\Columns\TextColumn;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UploadResource extends Resource
{
    protected static ?string $model = Upload::class;

    protected static ?string $navigationGroup = 'Product Management';

    protected static ?string $navigationIcon = 'heroicon-o-arrow-up-on-square';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('New Book')
                    ->schema([
                        TextInput::make('book_title')
                            ->required()
                            ->autofocus(),
                        Textarea::make('book_summary')
                            ->required()
                            ->autofocus(),
                        FileUpload::make('book_script')
                            ->required()
                            ->autofocus()
                            ->directory('/uploads')
                            ->getUploadedFileNameForStorageUsing(
                                fn (TemporaryUploadedFile $file): string =>'upload_' . uniqid() . '.' . $file->getClientOriginalExtension()
                            )
                            ->downloadable()
                            ->previewable()
                    ]),
                Section::make('Upload Status')
                    ->schema([
                        Select::make('status')
                            ->autofocus()
                            ->live(onBlur: true)
                            ->options([
                                'Pending' => UploadStatusEnum::PENDING->value,
                                'Approved' => UploadStatusEnum::APPROVED->value,
                                'Rejected' => UploadStatusEnum::REJECTED->value,
                            ])
                            ->default(UploadStatusEnum::PENDING)
                            ->disabled(fn () => !auth()->user()->hasRole('admin')),
                        Textarea::make('rejection_reason')
                            ->autofocus()
                            ->disabled(fn () => !auth()->user()->hasRole('admin')),
                    ])
                    ->hidden(function(Get $get) {
                        if (auth()->user()->hasRole('admin')) {
                            return false;
                        }

                        if ($get('status') != UploadStatusEnum::REJECTED->value) {
                            return true;
                        }
                    }),
                Section::make('Final Upload')
                    ->schema([
                        FileUpload::make('book_pdf')
                            ->live(onBlur: true)
                            ->autofocus()
                            ->disabled(function(Get $get) {
                                if (auth()->user()->hasRole('admin')) {
                                    return false;
                                }

                                if ($get('status') != UploadStatusEnum::APPROVED->value) {
                                    return true;
                                }
                            })
                    ])
                    ->hidden(function(Get $get) {
                        if (auth()->user()->hasRole('admin')) {
                            return false;
                        }

                        if ($get('status') != UploadStatusEnum::APPROVED->value) {
                            return true;
                        }
                    })
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('book_title'),
                TextColumn::make('user_id')
                    ->label('User Email')
                    ->formatStateUsing(fn (string $state): string => User::where('id', $state)->first()->email),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Rejected' => 'danger',
                        'Pending' => 'info',
                        'Approved' => 'success'
                    }),
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
            'index' => Pages\ListUploads::route('/'),
            'create' => Pages\CreateUpload::route('/create'),
            'edit' => Pages\EditUpload::route('/{record}/edit'),
        ];
    }
}

<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NewsletterResource\Pages;
use App\Models\Newsletter;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class NewsletterResource extends Resource
{
    protected static ?string $model = Newsletter::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->schema([
                    DateTimePicker::make('newsletter_timestamp')
                        ->label('Newsletter Timestamp')
                        ->seconds(false),
                    FileUpload::make('file_path')
                        ->reactive()
                        ->autofocus()
                        ->preserveFilenames()
                        ->acceptedFileTypes(['image/webp'])
                        ->label('Upload PDF')
                        ->image()
                        ->directory('/img')
                        ->getUploadedFileNameForStorage(function (callable $get, TemporaryUploadedFile $file): string {
                            $filename = 'newsletter_'.$file->getClientOriginalName();

                            return '/newsletters/'.$filename;
                        }),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('newsletter_timestamp')
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
            'index' => Pages\ListNewsletters::route('/'),
            'create' => Pages\CreateNewsletter::route('/create'),
            'edit' => Pages\EditNewsletter::route('/{record}/edit'),
        ];
    }
}

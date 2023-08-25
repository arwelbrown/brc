<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use App\Models\Publisher;
use Exception;
use Closure;
use Faker\Core\File;
use Filament\Forms;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Actions\DeleteAction;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\Layout;
use Filament\Tables\Filters\SelectFilter;
use FilesystemIterator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Livewire\TemporaryUploadedFile;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
//        $fileSysIterator = new FilesystemIterator(__DIR__ . '/../../../storage/app/public/img');
//
//        if(!empty($fileSysIterator->current())) {
//            //
//        }
//
////        move_uploaded_file(
////            from: __DIR__ . '/../../../storage/app/public/img/series_' . $series . '/covers/' . $coverTitle,
////            to: __DIR__ . '/../../../public/img/series_' . $series . '/covers/' . $coverTitle
////        );

        return $form
            ->schema([
                TextInput::make('product_name')
                                ->required()
                                ->autofocus()
                                ->placeholder('New Book #0')
                                ->maxLength(255),
                TextInput::make('series')
                                ->required()
                                ->autofocus()
                                ->placeholder('New Series')
                                ->maxLength(255),
                TagsInput::make('tags')
                                ->autofocus()
                                ->placeholder('Series 1, Series 2...')
                                ->separator(),
                TextInput::make('ejunkie_link_digital')
                                ->required()
                                ->autofocus()
                                ->maxLength(255)
                                ->label('EJunkie Digital Link'),
                TextInput::make('ejunkie_link_physical')
                                ->nullable()
                                ->autofocus()
                                ->maxLength(255)
                                ->label('Ejunkie Physical Link'),
                Select::make('publisher_id')
                                ->relationship('publisher', 'publisher_name')
                                ->autofocus()
                                ->preload()
                                ->createOptionForm([
                                    TextInput::make('publisher.publisher_name')
                                                    ->autofocus()
                                                    ->required()
                                                    ->maxLength(255),
                                    TextInput::make('publisher.publisher_email')
                                                    ->email()
                                                    ->autofocus()
                                                    ->maxLength(255)
                                                    ->required(),
                                    FileUpload::make('publisher.logo')
                                                    ->autofocus()
                                                    ->preserveFilenames()
                                                    ->nullable(),
                                    TextInput::make('publisher.description')
                                                    ->autofocus()
                                                    ->maxLength(2000)
                                                    ->nullable(),
                                    FileUpload::make('publisher.banner')
                                                    ->autofocus()
                                                    ->preserveFilenames()
                                                    ->nullable()
                                ])
                                ->required(),
                Textarea::make('summary')
                                ->autofocus()
                                ->columnSpan(2)
                                ->required()
                                ->placeholder('Enter summary...')
                                ->maxLength(2000),
                TextInput::make('digital_price')
                                ->numeric()
                                ->autofocus()
                                ->required(),
                TextInput::make('physical_price')
                                ->numeric()
                                ->autofocus()
                                ->nullable(),
                FileUpload::make('img_string')
                            ->autofocus()
                            ->preserveFilenames()
                            ->acceptedFileTypes(['image/webp'])
                            ->columnSpan(2)
                            ->label('Cover Image')
                            ->image()
                            ->directory('/img')
                            ->getUploadedFileNameForStorageUsing(function (TemporaryUploadedFile $file): string {
                                $explode = explode('%', $file->getClientOriginalName());
                                $series = strtolower($explode[0]);
                                $coverTitle = $explode[1];

                                return 'series_' . $series . '/covers/' . $coverTitle;
                            })
                            ->enableOpen()
                            ->enableDownload()
                            ->required(),
                Toggle::make('in_development')
                            ->autofocus()
                            ->default(false),
                Toggle::make('physical_available')
                            ->autofocus()
                            ->default(false),
//                Hidden::make('store_slug')
//                            ->default(function (Closure $get) {
//                                $store_slug = $get('product_name');
//                            })
//                            ->autofocus()
//                            ->required()
                TextInput::make('store_slug')
                            ->autofocus()
                            ->required()
            ]);
    }

    /**
     * @throws Exception
     */

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('product_name')
                            ->sortable()
                            ->searchable(),
                TextColumn::make('publisher.publisher_name')
                            ->searchable()
                            ->sortable(),
                TextColumn::make('digital_price')
                            ->money('usd', true)
                            ->label('Digital Price ($)'),
                TextColumn::make('physical_price')
                            ->money('usd', true)
                            ->label('Physical Price ($)')
                            ->placeholder('n/a')

            ])
            ->defaultSort('product_name')
            ->filters([
                //
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make()
            ])
            ->bulkActions([
                //
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit')
        ];
    }
}

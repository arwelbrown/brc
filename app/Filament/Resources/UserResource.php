<?php

namespace App\Filament\Resources;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Actions\EditAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use App\Filament\Resources\Users\Pages\ListUsers;
use App\Filament\Resources\Users\Pages\CreateUser;
use App\Filament\Resources\Users\Pages\EditUser;
use App\Models\User;
use Carbon\Carbon;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Hash;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use App\Enums\CompanyPositionEnum;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static string|\UnitEnum|null $navigationGroup = "Users";

    protected static string|\BackedEnum|null $navigationIcon = "heroicon-o-user-group";

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Section::make()
                ->schema([
                    TextInput::make("name")->autofocus()->required(),
                    TextInput::make("email")->autofocus()->required(),
                    DateTimePicker::make("email_verified_at")
                        ->default(Carbon::now())
                        ->seconds(false),
                    TextInput::make("password")
                        ->password()
                        ->maxLength(255)
                        ->dehydrateStateUsing(fn($state) => Hash::make($state))
                        ->dehydrated(fn($state) => filled($state)),
                    Select::make("roles")
                        ->multiple()
                        ->relationship("roles", "name")
                        ->preload(),
                    Select::make("brc_team_role")
                        ->label("BRC Role")
                        ->options([
                            "Founder" => CompanyPositionEnum::FOUNDER->value,
                            "Team" => CompanyPositionEnum::BRC_TEAM->value,
                            "Creator" => CompanyPositionEnum::CREATOR->value,
                        ])
                        ->autofocus(),
                    TextInput::make("position")->autofocus(),
                    Textarea::make("bio")->autofocus()->columnSpanFull(),
                    FileUpload::make("img_string")
                        ->label("Profile Picture")
                        ->columnSpanFull()
                        ->directory("img")
                        ->getUploadedFileNameForStorageUsing(
                            fn(
                                TemporaryUploadedFile $file,
                            ): string => "/br_admin/brc_team/" .
                                $file->getClientOriginalName(),
                        ),
                    Toggle::make("active"),
                ])
                ->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([TextColumn::make("name"), TextColumn::make("email")])
            ->filters([
                //
            ])
            ->recordActions([EditAction::make()])
            ->toolbarActions([
                BulkActionGroup::make([DeleteBulkAction::make()]),
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
            "index" => ListUsers::route("/"),
            "create" => CreateUser::route("/create"),
            "edit" => EditUser::route("/{record}/edit"),
        ];
    }

    public static function shouldRegisterNavigation(): bool
    {
        return auth()
            ->user()
            ->hasRole(["super-admin", "admin"]);
    }
}

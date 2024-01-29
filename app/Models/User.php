<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasAvatar;
use Filament\Panel;
use App\Models\Upload;
use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements FilamentUser, HasAvatar
{
    use HasApiTokens, HasFactory, HasRoles, Notifiable;

    public function canAccessPanel(Panel $panel): bool
    {
        $roles = Role::all();
        $roleNames = [];

        foreach ($roles as $role) {
            if ($role->getAttribute('name') != 'customer') {
                $roleNames[] = $role->getAttribute('name');
            }
        }

        return $this->hasRole($roleNames) && $this->hasVerifiedEmail();
    }

    public function getFilamentAvatarUrl(): ?string
    {
        return $this->avatar_url;
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function uploads(): HasOne
    {
        return $this->hasOne(Upload::class);
    }
    
    protected $fillable = [
        'name',
        'email',
        'password',
        'email_verified_at',
    ];
    
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function canManageSettings(): bool
    {
        return $this->hasRole('admin');
    }
}

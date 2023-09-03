<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Series extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $casts = [
        'writers' => 'array',
        'creators' => 'array',
        'artists' => 'array',
        'colorists' => 'array',
        'letterers' => 'array',
        'editors' => 'array', 
    ];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function characters(): HasMany
    {
        return $this->hasMany(Character::class);
    }
}

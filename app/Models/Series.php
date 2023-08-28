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

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function publisher(): BelongsTo
    {
        return $this->belongsTo(Publisher::class);
    }

    public function characters(): HasMany
    {
        return $this->hasMany(Character::class);
    }
}

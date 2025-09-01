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

    /**
     * Returns books in the series
     *
     * @return HasMany
     */
    public function books(): HasMany
    {
        return $this->hasMany(Book::class);
    }

    /**
     * Returns any characters appearing in the series
     *
     * @return HasMany
     */
    public function characters(): HasMany
    {
        return $this->hasMany(Character::class);
    }

    /**
     * Returns the createor model that the book belongs to
     *
     * @return BelongsTo
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(Creator::class);
    }
}

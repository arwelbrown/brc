<?php

namespace App\Models;

use App\Models\Series;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Canon extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';

    /**
     * Returns any series associated with this canon
     *
     * @return HasMany
     */
    public function sereis(): HasMany
    {
        return $this->hasMany(Series::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Universe extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    public function series(): HasMany
    {
        return $this->hasMany(Series::class);
    }

    protected $fillable = [
        'id',
        'universe_name',
    ];
}

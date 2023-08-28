<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Publisher extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}

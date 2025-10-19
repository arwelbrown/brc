<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method static paginate(int $int)
 */
class Book extends Model
{
    use HasFactory;

    protected $primaryKey = "id";
    protected $casts = [
        "tags" => "array",
        "in_development" => "integer",
        "physical_available" => "integer",
        "featured_product" => "integer",
        "active" => "integer",
    ];

    public function series(): BelongsTo
    {
        return $this->belongsTo(Series::class);
    }

    public function characters(): HasMany
    {
        return $this->hasMany(Character::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    protected $fillable = [
        "id",
        "name",
        "series",
        "tags",
        "store_slug",
        "ejunkie_link_digital",
        "ejunkie_link_physical",
        "summary",
        "digital_price",
        "physical_price",
        "img_string",
        "in_development",
        "physical_available",
        "created_at",
        "updated_at",
        "active",
    ];
}

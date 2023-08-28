<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @method static paginate(int $int)
 */
class Product extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $casts = [
        'tags' => 'array',
        'in_development' => 'integer',
        'physical_available' => 'integer'
    ];

    public function publisher(): BelongsTo
    {
        return $this->belongsTo(Publisher::class);
    }

    public function series(): BelongsTo
    {
        return $this->belongsTo(Series::class);
    }

    protected $fillable = [
        'id',
        'product_name',
        'series',
        'store_slug',
        'ejunkie_link_digital',
        'ejunkie_link_physical',
        'publisher_id',
        'summary',
        'digital_price',
        'physical_price',
        'img_string',
        'in_development',
        'physical_available',
        'created_at',
        'updated_at'
    ];
}

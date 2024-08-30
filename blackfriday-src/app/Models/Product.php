<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @mixin Builder
 */
class Product extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'Products';

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var string
     */
    protected $primaryKey = 'asin';
    /**
     * @var string
     */
    protected $keyType = 'string';

    /**
     * @var string[]
     */
    protected $fillable = [
        'asin',
        'title',
        'imgUrl',
        'productUrl',
        'stars',
        'reviews',
        'price',
        'isBestSeller',
        'boughtInLastMonth',
        'categoryName',
    ];

    /**
     * @return HasMany
     */
    public function baskets(): HasMany
    {
        return $this->hasMany(Basket::class, 'ProductId', 'asin');
    }

    /**
     * @return HasOne
     */
    public function productCount(): HasOne
    {
        return $this->hasOne(ProductCount::class, 'Asin', 'asin');
    }
}

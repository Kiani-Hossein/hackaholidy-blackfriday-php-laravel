<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @mixin Builder
 */
class Basket extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'Baskets';

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var string
     */
    protected $primaryKey = 'BasketId';

    /**
     * @var string[]
     */
    protected $fillable = [
        'BasketId',
        'ProductId',
        'UserId',
        'IsCheckedOut',
    ];

    /**
     * @return BelongsTo
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'ProductId', 'asin',);
    }
}

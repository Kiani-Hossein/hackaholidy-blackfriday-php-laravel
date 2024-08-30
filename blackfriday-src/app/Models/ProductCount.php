<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 *
 */
class ProductCount extends Model
{
    use HasFactory;

    protected $table = 'ProductCounts';

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var string
     */
    protected $primaryKey = 'Asin';

    /**
     * @var string[]
     */
    protected $fillable = [
        'Asin',
        'Count',
    ];

    /**
     * @return BelongsTo
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'Asin', 'asin');
    }
}

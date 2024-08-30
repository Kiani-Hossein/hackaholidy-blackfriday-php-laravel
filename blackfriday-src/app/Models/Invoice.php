<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @mixin Builder
 */
class Invoice extends Model
{
    use HasFactory;

    /**
     * @var null
     */
    public $primaryKey = null;

    /**
     * @var bool
     */
    public $incrementing = false;

    /**
     * @var string
     */
    protected $table = 'Invoices';

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var string[]
     */
    protected $fillable = [
        'BasketId',
        'UserId',
        'Items',
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'Items' => 'object',
    ];

    /**
     * @return BelongsTo
     */
    public function basket(): BelongsTo
    {
        return $this->belongsTo(Basket::class, 'BasketId', 'BasketId');
    }
}

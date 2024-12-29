<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderDt extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'order_dt';

    protected $fillable = [
        'order_hd_id', // Foreign key to OrderHd
        'product_id',  // Foreign key to Product
        'total',
        'price',
    ];

    /**
     * Get the order header for the OrderDt.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function orderHD(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(OrderHd::class, 'order_hd_id');
    }

    /**
     * Get the product for the OrderDt.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}

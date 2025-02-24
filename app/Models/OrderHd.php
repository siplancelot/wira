<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;

class OrderHd extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'order_hd';

    protected $fillable = [
        'title',
        'name',
        'total_product',
        'total_price',
        'payment_method'
    ];

    /**
     * Get the orderDT that owns the OrderHd
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function orderDT(): BelongsTo
    {
        return $this->belongsTo(OrderDt::class, 'order_hd_id');
    }
}

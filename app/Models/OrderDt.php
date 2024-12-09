<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderDt extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "order_dt";
    
    protected $fillable = [
        'order_hd_id',
        'product_id',
        'total',
        'price'
    ];

    /**
     * Get all of the orderHD for the OrderDt
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orderHD(): HasMany
    {
        return $this->hasMany(OrderHd::class);
    }

    /**
     * Get all of the products for the OrderDt
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}

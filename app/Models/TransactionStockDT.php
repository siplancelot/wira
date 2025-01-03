<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransactionStockDT extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'transaction_stock_dt';

    protected $fillable = [
        'transaction_stock_hd_id',
        'product_id',
        'total',
        'price',
    ];

    public function transaction_stock_hd()
    {
        return $this->belongsTo(TransactionStockHD::class, 'transaction_stock_hd_id', 'id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}

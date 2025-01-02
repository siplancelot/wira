<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransactionStockHD extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'transaction_stock_hd';

    protected $fillable = [
        'title',
        'total',
        'price',
    ];

    public function transaction_stock_dt()
    {
        return $this->belongsTo(TransactionStockDT::class, 'transaction_stock_hd_id', 'id');
    }
}

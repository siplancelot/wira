<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction_stock_hd extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'transaction_stock_hd';

    protected $fillable = [
        'total',
        'price',
    ];

    public function transaction_stock_dt()
    {
        return $this->belongsTo(Transaction_stock_dt::class, 'transaction_stock_hd_id', 'id');
    }
}

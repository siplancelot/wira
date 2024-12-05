<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderHd extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'name',
        'total_product',
        'total_price',
        'payment_method'
    ];
}

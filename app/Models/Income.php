<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Income extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'income_category_id',
        'total',
        'description',
        'no_reference',
    ];

    public function incomeCategory()
    {
        return $this->belongsTo(IncomeCategory::class, 'income_category_id', 'id');
    }
}

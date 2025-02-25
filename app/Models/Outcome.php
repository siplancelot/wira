<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Outcome extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'outcome_category_id',
        'total',
        'description',
        'no_reference'
    ];

    public function outcomeCategory()
    {
        return $this->belongsTo(OutcomeCategory::class, 'outcome_category_id', 'id');
    }
}

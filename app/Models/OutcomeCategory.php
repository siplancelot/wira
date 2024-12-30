<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OutcomeCategory extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'outcome_categories';

    protected $fillable = [
        'name'
    ];

    public function outcomes()
    {
        return $this->hasMany(Outcome::class, 'outcome_category_id', 'id');
    }
}

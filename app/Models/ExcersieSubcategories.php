<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExcersieSubcategories extends Model
{
    use HasFactory;

    protected $table = 'exercise_subcategories';

    protected $fillable = [
        'category_id',
        'exercise_id',
    ];
}

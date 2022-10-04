<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExcersieSubcategories extends Model
{
    use HasFactory;

    protected $table = 'categories_exercises';

    protected $fillable = [
        'categories_id',
        'exercises_id',
    ];
}

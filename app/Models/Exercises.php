<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exercises extends Model
{
    use HasFactory;

    protected $table = 'exercises';

    public function videos()
    {
        return $this->hasMany(ExerciseVideos::class,'exercise_id');
    }

    public function categorie()
    {
        return $this->belongsToMany(Categories::class);
    }

    protected $fillable = [
        'name',
        'image',
        'short_description',
        'instructions',
    ];
}

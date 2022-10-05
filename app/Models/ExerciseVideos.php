<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExerciseVideos extends Model
{
    use HasFactory;

    protected $table = 'exercise_videos';

    public function exercise()
    {
        return $this->belongsTo(Exercises::class,'id');
    }

    protected $fillable = [
        'video',
    ];

}

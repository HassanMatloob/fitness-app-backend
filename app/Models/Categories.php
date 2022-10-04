<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;

    protected $table = 'categories';
    private $descendants = [];

    public function subcategories()
    {
        return $this->hasMany(Categories::class, 'parent_id');
    }

    public function children()
    {
        return $this->subcategories()->with('children');
    }

    public function hasChildren()
    {
        if ($this->children->count()) {
            return true;
        }

        return false;
    }

    public function findDescendants(Categories $category)
    {
        $this->descendants[] = $category->id;

        if ($category->hasChildren()) {
            foreach ($category->children as $child) {
                $this->findDescendants($child);
            }
        }
    }

    public function getDescendants(Categories $category)
    {
        $this->findDescendants($category);
        return $this->descendants;
    }

    public function exercise(){
        return $this->belongsToMany(Exercises::class);
    }

    protected $fillable = [
        'name',
        'image',
        'parent_id',
    ];
}

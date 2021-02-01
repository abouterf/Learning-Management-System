<?php

namespace abouterf\Category\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = [];

    public function getParentAttribute()
    {
        return !$this->parentCategory || !$this->parent_id ? 'ندارد' : $this->parentCategory->title;
    }

    public function parentCategory()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function subCategories()
    {
        $this->hasMany(Category::class, 'parent_id');
    }

    public function courses()
    {
        $this->hasMany(Course::class);
    }
}

<?php

namespace abouterf\Course\Models;

use abouterf\Media\Models\Media;
use abouterf\User\Models\User;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    /*
        best practice for this kind of static values are const ones.
        e.g. const TYPE_FREE = 'cach';
    */
    protected $guarded = [];
    static $types = ['free', 'cash'];
    static $statuses = ['completed', 'not-completed', 'locked'];

    public function getThumbAttribute()
    {
        return '/storage/' . $this->banner->files[300];
    }
    public function banner()
    {
        return $this->belongsTo(Media::class, 'banner_id');
    }
    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }
}

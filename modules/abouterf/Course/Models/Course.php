<?php

namespace abouterf\Course\Models;

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
}

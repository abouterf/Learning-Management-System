<?php

namespace abouterf\Course\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    static $types = ['free', 'cash'];
    static $statuses = ['completed', 'not-completed', 'locked'];
}

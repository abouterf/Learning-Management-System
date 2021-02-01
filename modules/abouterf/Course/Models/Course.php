<?php

namespace abouterf\Course\Models;

use abouterf\Category\Models\Category;
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

    const TYPE_FREE = 'free';
    const TYPE_CASH = 'cash';
    const STATUS_COMPLETED = 'completed';
    const STATUS_NOT_COMPLETED = 'not-completed';
    const STATUS_LOCKED = 'locked';
    const CONFIRMATION_STATUS_ACCEPTED = 'accepted';
    const CONFIRMATION_STATUS_REJECTED = 'rejected';
    const CONFIRMATION_STATUS_LOCKED = 'locked';
    const CONFIRMATION_STATUS_PENDING = 'pending';

    static $confirmation_statuses = [
        self::CONFIRMATION_STATUS_ACCEPTED,
        self::CONFIRMATION_STATUS_REJECTED,
        self::CONFIRMATION_STATUS_LOCKED,
        self::CONFIRMATION_STATUS_PENDING
    ];


    public function banner()
    {
        return $this->belongsTo(Media::class, 'banner_id');
    }
    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}

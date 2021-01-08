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

    const CONFIRMATION_STATUS_ACCEPTED = 'accepted';
    const CONFIRMATION_STATUS_REJECTED = 'rejected';
    const CONFIRMATION_STATUS_LOCKED = 'locked';

    static $confirmation_statuses = [
        self::CONFIRMATION_STATUS_ACCEPTED,
        self::CONFIRMATION_STATUS_REJECTED,
        self::CONFIRMATION_STATUS_LOCKED
    ];


    public function banner()
    {
        return $this->belongsTo(Media::class, 'banner_id');
    }
    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }
}

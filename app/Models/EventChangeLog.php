<?php

namespace App\Models;

use App\Traits\Uuids;
// use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model;

class EventChangeLog extends Model
{
    use Uuids;
    protected $connection = 'mongodb';

    protected $collection = 'event_change_log';
    // protected $connection = 'mongodb';
    protected $fillable = [
        'user',
        'event_id',
        'date_changed',
        'name',
        'original_teacher',
        'new_teacher',
        'original_classroom',
        'new_classroom',
        'original_start_date',
        'new_start_date',
    ];
}

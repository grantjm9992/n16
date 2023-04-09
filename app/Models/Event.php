<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    use Uuids;

    protected $appends = [
        'start', 'end', 'resourceId', 'title',
    ];

    public function getStartAttribute()
    {
        return $this->start_date;
    }

    public function getEndAttribute()
    {
        return $this->end_date;
    }

    public function getResourceIdAttribute()
    {
        return $this->classroom_id ?? null;
    }

    public function getTitleAttribute()
    {
        return $this->description;
    }

    protected $fillable = [
        'id',
        'company_id',
        'description',
        'classroom_id',
        'classroom_name',
        'teacher_id',
        'teacher_name',
        'teacher_colour',
        'event_type_id',
        'event_type_colour',
        'group_id',
        'group_name',
        'user_id',
        'user_name',
        'department_id',
        'start_date',
        'end_date',
        'status_id',
        'series_id',
        'resource_id',
        'pre_painted',
    ];
}

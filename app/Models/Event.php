<?php

namespace App\Models;

use App\Traits\Uuids;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Event extends Model
{
    use HasFactory;
    use Uuids;

    protected $appends = [
        'start', 'end', 'resourceId', 'title', 'backgroundColor', 'textColor', 'borderColor',
    ];

    public function teacher(): BelongsTo
    {
        return $this->belongsTo(Teacher::class);
    }

    public function getBorderColorAttribute(): ?string
    {
        if ((int)$this->status_id !== 1) {
            return 'black';
        }
        if (!$this->teacher) {
            return 'black';
        }
        return $this->teacher?->colour;
    }

    public function getBackgroundColorAttribute(): ?string
    {
        if ((int)$this->status_id !== 1) {
            return '#f4ecc5';
        }
        return $this->teacher?->colour;
    }

    public function getTextColorAttribute(): ?string
    {
        if ((int)$this->status_id !== 1) {
            return 'white';
        }
        return $this->teacher?->text_colour;
    }

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
        'holiday_id',
    ];

    public function getDurationInSeconds(): int
    {
        return Carbon::createFromFormat('Y-m-d H:i', $this->end_date)->getTimestamp() -
            Carbon::createFromFormat('Y-m-d H:i', $this->start_date)->getTimestamp();
    }
}

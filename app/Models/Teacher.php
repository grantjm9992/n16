<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Teacher extends AbstractModel
{
    use HasFactory;
    use Uuids;

    protected $appends = ['title'];

    protected $fillable = [
        'id',
        'old_id',
        'name',
        'surname',
        'email',
        'phone',
        'colour',
        'text_colour',
        'hours',
        'morning',
        'available',
        'start_date',
        'start_hours',
        'leave_date',
        'teacher_type_id',
        'company_id',
    ];

    public function getTitleAttribute(): string
    {
        return $this->name;
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function events(): HasMany
    {
        return $this->hasMany(Event::class);
    }

    public function toArray(): array
    {
        $array = parent::toArray();
        $array['surname'] = $array['surname'] ?? '';
        return $array;
    }
}

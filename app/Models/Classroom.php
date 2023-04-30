<?php

namespace App\Models;

use App\Traits\Uuids;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Classroom extends AbstractModel
{
    use HasFactory;
    use Uuids;

    protected $appends = ['title'];
    protected $fillable = [
        'name',
        'old_id',
        'company_id',
        'fill_colour',
        'border_colour',
        'text_colour',
        'capacity',
        'order',
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function getTitleAttribute()
    {
        return $this->name;
    }
}

<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeachingHours extends Model
{
    use HasFactory;
    use Uuids;

    protected $fillable = [
        'teacher_id',
        'last_updated',
        'total_seconds_worked',
    ];
}

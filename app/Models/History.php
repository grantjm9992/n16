<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;
    use Uuids;

    protected $table = 'history';

    protected $casts = [
        'original_entity' => 'array',
        'updated_entity' => 'array',
    ];

    protected $fillable = [
        'user_id',
        'user',
        'action',
        'entity',
        'original_entity',
        'updated_entity',
    ];
}

<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends AbstractModel
{
    use HasFactory;
    use Uuids;

    protected $fillable = [
        'name',
        'data',
    ];
}

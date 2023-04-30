<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends AbstractModel
{
    use HasFactory;
    use Uuids;

    protected $fillable = [
        'name',
        'parent_id',
    ];
}

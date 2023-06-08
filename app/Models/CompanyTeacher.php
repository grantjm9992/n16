<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CompanyTeacher extends AbstractModel
{
    use HasFactory;
    use Uuids;

    protected $fillable = [
        'teacher_id',
        'company_id',
    ];
}

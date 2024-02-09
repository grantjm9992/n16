<?php

namespace App\Models;

use App\Traits\Uuids;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

use Jenssegers\Mongodb\Eloquent\Model;

class Resource extends Model
{

    use HasFactory;
    use Uuids;

    protected $connection = 'mongodb';
    protected $fillable = [
        'name',
        'resource_type_id',
        'company_id',
    ];

    public function resourceType(): HasOne
    {
        return $this->hasOne(ResourceType::class);
    }
}

<?php declare(strict_types=1);

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model;

class Role extends Model
{

    use HasFactory;
    use Uuids;

    protected $connection = 'mongodb';
    protected $fillable = [
        'name',
        'company_id',
    ];
}

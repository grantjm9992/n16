<?php declare(strict_types=1);

namespace App\Models;

use App\Traits\Uuids;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Company extends Model
{

    use HasFactory;
    use Uuids;

    protected $fillable = [
        'name',
        'admin_user_id',
        'address',
        'city',
        'country',
        'postcode',
        'number_of_employees',
        'sector_id',
    ];

    public function adminUser(): HasOne
    {
        return $this->hasOne(User::class, 'admin_user_id');
    }

    public function employees(): HasMany
    {
        return $this->hasMany(User::class);
    }
}

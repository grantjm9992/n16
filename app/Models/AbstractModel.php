<?php

namespace App\Models;

use App\Services\HistoryService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class AbstractModel extends Model
{
    public static function boot()
    {
        parent::boot();

        $user = Auth::user();
        if (null === $user) {
            return;
        }

        $user = $user->toArray();

        self::created(function(Model $model) use ($user) {
            HistoryService::insertAction($user['id'], 'create', get_class($model), $model->toArray(), $model->toArray());
        });

        self::updated(function($model) use ($user) {
            HistoryService::insertAction($user['id'], 'update', get_class($model), $model->toArray(), $model->toArray());
        });

        self::deleted(function($model) use ($user) {
            HistoryService::insertAction($user['id'], 'delete', get_class($model), $model->toArray(), []);
        });
    }
}

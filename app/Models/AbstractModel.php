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
            $toArray = $model->toArray();
            $rawOriginal = $model->getRawOriginal();
            if (get_class($model) === Event::class) {
                $toArrayTeacher = Teacher::find($toArray['teacher_id']);
                $rawOriginalTeacher = Teacher::find($rawOriginal['teacher_id']);
                if ($toArrayTeacher) {
                    $toArray['teacher_name'] = $toArrayTeacher['name'] . $toArrayTeacher['surname'];
                }
                if ($rawOriginalTeacher) {
                    $rawOriginal['teacher_name'] = $rawOriginalTeacher['name'] . $rawOriginalTeacher['surname'];
                }
            }
            HistoryService::insertAction($user['id'], 'update', get_class($model), $toArray, $rawOriginal);
        });

        self::deleted(function($model) use ($user) {
            HistoryService::insertAction($user['id'], 'delete', get_class($model), $model->toArray(), []);
        });
    }
}

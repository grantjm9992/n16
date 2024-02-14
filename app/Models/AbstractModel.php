<?php

namespace App\Models;

use App\Services\HistoryService;
// use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Jenssegers\Mongodb\Eloquent\Model;

class AbstractModel extends Model
{
    protected $connection = 'mongodb';
    public static function boot()
    {
        parent::boot();

        $user = Auth::user();
        if (null === $user) {
            return;
        }

        $user = $user->toArray();


        self::created(function(Model $model) use ($user) {
            HistoryService::insertAction($user['_id'], 'create', get_class($model), $model->toArray(), $model->toArray());
        });

        self::updated(function($model) use ($user) {
            $toArray = $model->toArray();
            $rawOriginal = $model->getRawOriginal();
            if (get_class($model) === Event::class) {
                HistoryService::insertEventLog(
                    $user['_id'],
                    $toArray['id'],
                    $toArray['description'],
                    $rawOriginal['teacher_id'],
                    $toArray['teacher_id'],
                    $rawOriginal['classroom_id'],
                    $toArray['classroom_id'],
                    $rawOriginal['start_date'],
                    $toArray['start_date']
                );
            } else {
                HistoryService::insertAction($user['_id'], 'update', get_class($model), $toArray, $rawOriginal);
            }
        });

        self::deleted(function($model) use ($user) {
            HistoryService::insertAction($user['_id'], 'delete', get_class($model), $model->toArray(), []);
        });
    }

    public function toArray(): array
    {
        $array = parent::toArray();
        $array['id'] = $array['_id'] ?? null;
        if (array_key_exists('status_id', $array)) {
            $array['status_id'] = (string)$array['status_id'];
        }
        return $array;
    }
}

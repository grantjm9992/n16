<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\EventTypeController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\HistoryLogController;
use App\Http\Controllers\HolidayController;
use App\Http\Controllers\ResourceController;
use App\Http\Controllers\ResourceTypeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\TeachingHourController;
use App\Http\Controllers\UsersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');
});

Route::middleware('jwt.verify')->group(function() {
    Route::controller(CompanyController::class)->prefix('companies/')->group(function() {
        Route::get('', 'index');
        Route::get('{id}', 'show');
        Route::delete('{id}', 'delete');
        Route::post('{id}', 'update');
        Route::post('', 'store');
    });

    Route::controller(UsersController::class)->prefix('users/')->group(function() {
        Route::get('', 'listAll');
        Route::get('teachers/list', 'listAllTeachers');
        Route::get('{id}', 'find');
        Route::delete('{id}', 'delete');
        Route::post('{id}', 'update');
        Route::post('{id}/update-password', 'updatePassword');
        Route::post('', 'create');
    });

    Route::controller( ResourceTypeController::class)->prefix('resource-type/')->group(function() {
        Route::get('', 'index');
        Route::get('{id}', 'find');
        Route::post('', 'create');
        Route::post('{id}', 'update');
        Route::delete('{id}', 'delete');
    });

    Route::controller( EventTypeController::class)->prefix('event-type/')->group(function() {
        Route::get('', 'index');
        Route::get('{id}', 'find');
        Route::post('', 'create');
        Route::post('{id}', 'update');
        Route::delete('{id}', 'delete');
    });

    Route::controller( DepartmentController::class)->prefix('department/')->group(function() {
        Route::get('', 'index');
        Route::get('{id}', 'find');
        Route::post('', 'create');
        Route::post('{id}', 'update');
        Route::delete('{id}', 'delete');
    });

    Route::controller( ClassroomController::class)->prefix('classroom/')->group(function() {
        Route::get('', 'index');
        Route::get('{id}', 'find');
        Route::post('', 'create');
        Route::post('{id}', 'update');
        Route::delete('{id}', 'delete');
    });

    Route::controller( EventController::class)->prefix('events/')->group(function() {
        Route::get('', 'index');
        Route::get('{id}', 'find');
        Route::post('', 'createRepeatedForDateRange');
        Route::post('/create/single', 'createSingleEvent');
        Route::post('{id}', 'update');
        Route::delete('{id}', 'delete');
        Route::post('update-classroom/{id}/{classroomId}', 'updateClassroom');
        Route::post('update-teacher/{id}/{teacherId}', 'updateTeacher');
        Route::post('update-teacher-for-group/{id}/{teacherId}', 'updateTeacherForGroup');
        Route::post('update-events-for-group/{groupId}', 'updateEventsForGroup');
        Route::post('delete-events-for-group/{groupId}', 'deleteEventsForGroup');
        Route::post('/update-dates/{id}', 'updateDates');
    });

    Route::controller( TeacherController::class)->prefix('teacher/')->group(function() {
        Route::get('', 'index');
        Route::get('{id}', 'find');
        Route::post('', 'create');
        Route::post('{id}', 'update');
        Route::delete('{id}', 'delete');
    });

    Route::controller( ResourceController::class)->prefix('resource/')->group(function() {
        Route::get('', 'index');
        Route::get('{id}', 'find');
        Route::post('', 'create');
        Route::post('{id}', 'update');
        Route::delete('{id}', 'delete');
    });

    Route::controller(RoleController::class)->prefix('roles/')->group(function() {
        Route::post('', 'create');
        Route::get('', 'index');
        Route::delete('{id}', 'delete');
    });

    Route::controller( GroupController::class)->prefix('groups/')->group(function () {
        Route::get('', 'index');
    });

    Route::controller( TeachingHourController::class)->prefix('teaching-hours/')->group(function () {
        Route::get('', 'data');
    });

    Route::controller( HistoryLogController::class)->prefix('history-log/')->group(function () {
        Route::get('', 'index');
    });

    Route::controller( HolidayController::class)->prefix('holidays/')->group(function () {
        Route::get('', 'index');
        Route::post('', 'create');
        Route::post('{id}', 'update');
        Route::get('{id}', 'find');
        Route::get('{id}/accept', 'accept');
        Route::get('{id}/reject', 'reject');
        Route::get('{id}/revoke', 'revoke');
    });
});

<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TasksController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('health', function () {
    return response()->json(['message' => 'FLIP SAUDE']);
});

Route::group(['prefix' => 'auth'], function () {
    Route::post('login', [AuthController::class, 'login']);
});

Route::group(['prefix' => 'user'], function () {
    Route::post('signup', [UsersController::class, 'signup']);
});

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::group(['prefix' => 'task'], function () {

        Route::get('', [TasksController::class, 'index'])->name('task-list');
        Route::get('/{id}', [TasksController::class, 'show'])->name('task-show');
        Route::post('', [TasksController::class, 'storeTask'])->name('task-store');

        Route::group(['middleware' => 'CheckTaskOwner'], function () {
            Route::delete('/{id}', [TasksController::class, 'destroy'])->name('task-delete');
            Route::patch('/{id}', [TasksController::class, 'update'])->name('task-update');
        });
    });
});

Route::any('/{any}', function () {
    return response()->json(['message' => 'Invalid router'], 404);
})->where('any', '.*');


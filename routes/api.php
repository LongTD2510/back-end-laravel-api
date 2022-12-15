<?php

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
Route::post('/register', [\App\Http\Controllers\ApiUserController::class, 'register']);
Route::post('/login', [\App\Http\Controllers\ApiUserController::class, 'login']);
Route::get('/list', [\App\Http\Controllers\PostController::class, 'listPost']);
Route::post('/refesh-token', [\App\Http\Controllers\ApiUserController::class, 'refreshToken']);

Route::middleware(['auth:api'])->group(static function () {
    Route::get('/logout', [\App\Http\Controllers\ApiUserController::class, 'logout']);
    Route::group(['prefix' => 'user'], static function () {
        Route::get('/info', [\App\Http\Controllers\ApiUserController::class, 'userInfo']);
    });
    Route::group(['prefix' => 'post'], static function () {
        Route::post('/create', [\App\Http\Controllers\PostController::class, 'createPost']);
        Route::get('/detail/{id}', [\App\Http\Controllers\PostController::class, 'detailPost']);
        Route::post('edit/{id}', [\App\Http\Controllers\PostController::class, 'updatePost']);
        Route::post('delete/{id}', [\App\Http\Controllers\PostController::class, 'deletePost']);
//        Route::get('/list', [\App\Http\Controllers\PostController::class, 'listPost']);
    });
    Route::group(['prefix' => 'real-time'], static function () {
        Route::get('/list', [\App\Http\Controllers\MessageController::class, 'messages']);
        Route::post('/add-messages', [\App\Http\Controllers\MessageController::class, 'addMessages']);
        Route::group(['prefix' => 'room'], static function () {
            Route::post('/create', [\App\Http\Controllers\RoomController::class, 'createRoomChat']);
            Route::get('/list', [\App\Http\Controllers\RoomController::class, 'listRoomChat']);
            Route::get('/filterRoom', [\App\Http\Controllers\RoomController::class, 'filterRoomChat']);
        });
    });
});

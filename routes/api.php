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


Route::middleware(['auth:api'])->group(static function () {
    Route::get('/logout', [\App\Http\Controllers\ApiUserController::class, 'logout']);
    Route::group(['prefix' => 'user'], static function () {
        Route::get('/info', [\App\Http\Controllers\ApiUserController::class, 'userInfo']);
    });
});

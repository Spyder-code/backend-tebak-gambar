<?php

use App\Http\Controllers\UserController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('users', UserController::class);


Route::resource('rooms', App\Http\Controllers\API\RoomAPIController::class);


Route::resource('room_plays', App\Http\Controllers\API\RoomPlayAPIController::class);

Route::resource('log_activities', App\Http\Controllers\API\LogActivityAPIController::class);

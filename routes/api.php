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

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Authorization");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::resource('users', UserController::class);
Route::post('login', [App\Http\Controllers\API\UserController::class,'login']);
Route::post('register', [App\Http\Controllers\API\UserController::class,'register']);

Route::group(['middleware' => 'auth:api'], function(){
	Route::post('details', [App\Http\Controllers\API\UserController::class,'details']);
	Route::post('updateProfile', [App\Http\Controllers\API\UserController::class,'updateProfile']);
	Route::post('updatePassword', [App\Http\Controllers\API\UserController::class,'updatePassword']);
	Route::post('logout', [App\Http\Controllers\API\UserController::class,'logout']);
});

Route::resource('rooms', App\Http\Controllers\API\RoomAPIController::class);


Route::resource('room_plays', App\Http\Controllers\API\RoomPlayAPIController::class);

Route::resource('log_activities', App\Http\Controllers\API\LogActivityAPIController::class);

<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserApiController;

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

//get api for view user
Route::get('/users/{id?}',[UserApiController::class,'showUser']);

//post api for add user
Route::post('/add-users',[UserApiController::class,'addUser']);

//post api for add multiple user
Route::post('/add-multiple-users',[UserApiController::class,'addMultipleUser']);

//put api for update user
Route::put('/update-users/{id?}',[UserApiController::class,'updateUser']);

//patch api for update  single user
Route::patch('/update-single-record/{id?}',[UserApiController::class,'updateSingleRecord']);

//delete api for update  single user
Route::delete('/delete-single-user/{id?}',[UserApiController::class,'deleteSingleUser']);

//delete api for update  single user
Route::delete('/delete-multiple-user/{id?}',[UserApiController::class,'deleteMultipleUser']);


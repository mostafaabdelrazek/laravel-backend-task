<?php

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

Route::post('register' , [App\Http\Controllers\UsersController::class , 'register']);
Route::post('deleteuser' , [App\Http\Controllers\UsersController::class , 'delete']);
Route::get('getallusers' , [App\Http\Controllers\UsersController::class , 'getAll']);
Route::get('getusers/{display?}' , [App\Http\Controllers\UsersController::class , 'getUsersPaginate']);
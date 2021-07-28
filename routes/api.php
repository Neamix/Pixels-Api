<?php

use App\Http\Controllers\MusicController;
use App\Http\Controllers\PlaylistController;
use App\Http\Controllers\userManagment;
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


Route::post('login',[userManagment::class,'index']);
Route::post('register',[userManagment::class,'store']);
Route::post('logout',[userManagment::class,'delete'])->middleware('auth:sanctum');

Route::group(['middleware' => ['auth:sanctum'],'prefix'=>'music'], function () {
    Route::post('/',[MusicController::class,'store']);
    Route::get('/{id}',[MusicController::class,'show'])->whereNumber('id');
});

Route::group(['middleware' => ['auth:sanctum'],'prefix'=>'playlist'], function () {
    Route::post('/',[PlaylistController::class,'store']);
    Route::get('/get',[PlaylistController::class,'index']);
});

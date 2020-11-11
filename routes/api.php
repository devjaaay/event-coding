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
Route::middleware('api')->post('/event/save', 'App\Http\Controllers\EventController@save');
Route::middleware('api')->get('/event/list', 'App\Http\Controllers\EventController@index');

Route::middleware('api')->get('/user', function (Request $request) {
    return $request->user();
});

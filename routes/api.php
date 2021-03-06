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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/repositories', 'RepositoryController@index')->middleware('counter');

Route::post('/repositories', 'RepositoryController@store');

Route::delete('/repositories/{id}', 'RepositoryController@destroy');

Route::get('/traffic', 'TrafficController@index');

Route::get('/traffic/{id}', 'TrafficController@show');
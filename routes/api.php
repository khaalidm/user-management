<?php

use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/workers', 'App\Http\Controllers\WorkerController@index');
Route::get('/workers/{worker}', 'App\Http\Controllers\WorkerController@show');
Route::post('/workers', 'App\Http\Controllers\WorkerController@store');
Route::put('/workers/{worker}', 'App\Http\Controllers\WorkerController@update');
Route::delete('/workers/{worker}', 'App\Http\Controllers\WorkerController@delete');

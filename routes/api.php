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


Route::get('actuador/porton',[App\Http\Controllers\ActuadorController::class,'observer']);
Route::get('actuador/porton/close',[App\Http\Controllers\ActuadorController::class,'forceCloseNotification']);



Route::get('actuador/observers/{idActuador}',[App\Http\Controllers\ActuadorController::class,'observerAlarms']);


Route::post('humedad',[App\Http\Controllers\HumedadController::class,'store']);
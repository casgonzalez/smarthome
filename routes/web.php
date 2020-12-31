<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',[\App\Http\Controllers\PageController::class,'dashboard'])->middleware('auth');

Route::get('login',[\App\Http\Controllers\AuthController::class,'form'])->name('login')->middleware('guest');
Route::post('login',[\App\Http\Controllers\AuthController::class,'login']);
Route::post('logout',[\App\Http\Controllers\AuthController::class,'logout']);

Route::get('activar-cuenta',[\App\Http\Controllers\UsuariosController::class,'activateAccount']);

Route::post('perfil/changeProfileImage',[\App\Http\Controllers\UsuariosController::class,'changeProfileImage']);


/**********************************ADMINISTRACION***********************************/

Route::group(['prefix'=>'administracion','middleware'=>'auth'],function(){

    Route::get('usuarios',[\App\Http\Controllers\UsuariosController::class,'index']);
    Route::get('usuarios/create',[\App\Http\Controllers\UsuariosController::class,'create']);

    Route::post('usuarios',[\App\Http\Controllers\UsuariosController::class,'store']);

    Route::delete('usuarios/{idUser}',[\App\Http\Controllers\UsuariosController::class,'destroy']);

    Route::get('usuarios/password-change',[\App\Http\Controllers\UsuariosController::class,'changePassword']);

});

Route::post('alarmas',[\App\Http\Controllers\AlarmaController::class,'store'])->middleware('auth');


Route::get('sendMessage',[\App\Http\Controllers\AlarmaController::class,'messsage']);

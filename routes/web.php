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

Route::get('welcome',[\App\Http\Controllers\AuthController::class,'welcome']);

Route::get('activar-cuenta',[\App\Http\Controllers\UsuariosController::class,'activateAccount']);

Route::get('perfil',[\App\Http\Controllers\UsuariosController::class,'profile']);
Route::post('perfil/changeProfileImage',[\App\Http\Controllers\UsuariosController::class,'changeProfileImage']);


Route::put('actuadores',[\App\Http\Controllers\ActuadorController::class,'update']);

Route::get('forzar_puerta',[App\Http\Controllers\ActuadorController::class,'forzarPuerta']);

Route::post('alarma/{idactuador}',[\App\Http\Controllers\AlarmaController::class,'store']);

Route::get('notificaciones',[\App\Http\Controllers\PageController::class,'notificaciones']);

Route::delete('alarma/{idAlarm}',[\App\Http\Controllers\PageController::class,'deleteAlarm']);

/**********************************ADMINISTRACION***********************************/

Route::group(['prefix'=>'administracion','middleware'=>['auth','user_check']],function(){

    Route::get('usuarios',[\App\Http\Controllers\UsuariosController::class,'index']);
    Route::get('usuarios/create',[\App\Http\Controllers\UsuariosController::class,'create']);

    Route::post('usuarios',[\App\Http\Controllers\UsuariosController::class,'store']);

    Route::put('usuarios/{idUsuario}',[\App\Http\Controllers\UsuariosController::class,'update']);


    Route::delete('usuarios/{idUser}',[\App\Http\Controllers\UsuariosController::class,'destroy']);

    Route::get('usuarios/password-change',[\App\Http\Controllers\UsuariosController::class,'changePassword']);

});

Route::post('alarmas',[\App\Http\Controllers\AlarmaController::class,'store'])->middleware('auth');


Route::get('sendMessage',[\App\Http\Controllers\AlarmaController::class,'messsage']);

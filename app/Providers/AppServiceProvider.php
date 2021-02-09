<?php

namespace App\Providers;

use App\Notificacion;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*',function($view){

            $notificaciones = Notificacion::join('tbl_usuarios','notificacions.idUser','tbl_usuarios.idUsuario')
                ->join('actuators','notificacions.idActuador','actuators.id')
                ->select(
                    'notificacions.id',
                    'notificacions.state',
                    'tbl_usuarios.nombre',
                    'actuators.actuator',
                    'actuators.id as idActuador',
                    'notificacions.created_at'
                )
                ->orderBy('notificacions.id','DESC')
                ->whereDate('notificacions.created_at',now())
                ->where('is_view',0)
                ->get();


            $view->with('notificaciones',$notificaciones);
        });

    }
}

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
                ->select('tbl_usuarios.nombre','notificacions.*')
                ->orderBy('id','DESC')
                ->take(10)
                ->get();

            $view->with('notificaciones',$notificaciones);
        });

    }
}

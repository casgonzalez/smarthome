<?php

namespace App\Http\Controllers;

use App\Actuador;
use App\Mail\ForzeDoorMail;
use App\Notificacion;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ActuadorController extends Controller
{

    public function update(Request $request) {

        $idActuador = $request->idActuador;

        $actuador = Actuador::findOrFail($idActuador);

        $label    = '';

        if ($request->estado == null ) { // apagar
            $actuador->estado = 0;
            if($actuador->id == 5) {
                $label = "{$actuador->actuador} Se cerro";
            }else{
                $label = "{$actuador->actuador} Se apago";
            }
        }else{
            $actuador->estado = 1;
            if($actuador->id == 5) {
                $label = "{$actuador->actuador} Se abrio";
            }else{
                $label = "{$actuador->actuador} Se apago";
            }
        }

        switch ($actuador->id) {

            case 1 : {
                $icono = 'imagenes/actuadores/luz-';
                $actuador->icono =
                    $actuador->estado == 0 ? $icono .= 'apagada.png' : $icono.='prendida.png';
                $actuador->configuracion = $request->configuracion;
                break;
            }

            case 2 : {
                $icono = 'imagenes/actuadores/ventilador-';
                $actuador->icono =
                    $actuador->estado == 0 ? $icono .= 'apagado.png' : $icono.='prendido.png';
                $actuador->configuracion = $request->configuracion;
                break;
            }

            case 3 : {
                $icono = 'imagenes/actuadores/aire-';
                $actuador->icono =
                    $actuador->estado == 0 ? $icono .= 'apagado.png' : $icono.='prendido.png';
                break;
            }
            case 4 : {
                $icono = 'imagenes/actuadores/luz-';
                $actuador->icono =
                    $actuador->estado == 0 ? $icono .= 'apagada.png' : $icono.='prendida.png';
                break;
            }

            case 5 : {
                $icono = 'imagenes/actuadores/candado-';
                $actuador->icono =
                    $actuador->estado == 0 ? $icono .= 'apagado.png' : $icono.='prendido.png';

                // si ha sido abierta mandar correo

                break;
            }
        }


        $actuador->save();

        $notificacion = new Notificacion();
        $notificacion->idUser = Auth::user()->idUsuario;
        $notificacion->label  = $label;
        $notificacion->save();

        return back();
    }

    function forzeDoor() {

        DB::beginTransaction();

        try {

            $actuador = Actuador::findOrFail(6);

            $actuador->estado = 1;
            $actuador->save();

            DB::commit();

            $fecha = now();

            $userActive = Auth::user();

            $userAdmin  = User::first();

            $mail = new ForzeDoorMail($fecha,$userActive,$userAdmin);

            Mail::to($userAdmin->email)->send($mail);

            return back();

        }catch (\Exception $exception) {

            DB::rollBack();

        }

    }

}

<?php

namespace App\Http\Controllers;

use App\Actuador;
use App\Mail\ForzeDoorMail;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ActuadorController extends Controller
{

    public function update(Request $request) {

        $id = $request->id;

        $actuador = Actuador::findOrFail($id);


        if($request->noChangeState == 1 && $request->state == "on"){
            $actuador->nivel = $request->nivel;
            $actuador->save();
            return back();
        }
        $actuador->estado = $actuador->estado == 0 ? 1 : 0;

        switch ($actuador->id) {

            case 1 : {
                $icono = 'imagenes/actuadores/aire-';
                $actuador->icono =
                    $actuador->estado == 0 ? $icono .= 'apagado.png' : $icono.='prendido.png';
                break;
            }
            case 2 : {
                $icono = 'imagenes/actuadores/ventilador-';
                $actuador->icono =
                    $actuador->estado == 0 ? $icono .= 'apagado.png' : $icono.='prendido.png';
                $actuador->nivel = $request->nivel;
                break;
            }
            case 6 : {
                $icono = 'imagenes/actuadores/candado-';
                $actuador->icono =
                    $actuador->estado == 0 ? $icono .= 'apagado.png' : $icono.='prendido.png';

                // si ha sido abierta mandar correo
                if($request->estado == "on") {

                    $fecha = now();

                    $userActive = Auth::user();

                    $userAdmin  = User::first();

                    $mail = new ForzeDoorMail($fecha,$userActive,$userAdmin);

                    Mail::to($userAdmin->email)->send($mail);

                }
                break;
            }

            case 4 : {
                $icono = 'imagenes/actuadores/luz-';
                $actuador->icono =
                    $actuador->estado == 0 ? $icono .= 'apagada.png' : $icono.='prendida.png';
                $actuador->nivel = $request->nivel;
                break;
            }

            case 5 : {
                $icono = 'imagenes/actuadores/luz-';
                $actuador->icono =
                    $actuador->estado == 0 ? $icono .= 'apagada.png' : $icono.='prendida.png';
                break;
            }
        }

        $actuador->save();

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

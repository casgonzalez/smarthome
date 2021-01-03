<?php

namespace App\Http\Controllers;

use App\Actuador;
use Illuminate\Http\Request;

class ActuadorController extends Controller
{

    public function update(Request $request) {
        $id = $request->id;

        $actuador = Actuador::findOrFail($id);

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
                break;
            }
            case 3 : {
                $icono = 'imagenes/actuadores/candado-';
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
                $icono = 'imagenes/actuadores/luz-';
                $actuador->icono =
                    $actuador->estado == 0 ? $icono .= 'apagada.png' : $icono.='prendida.png';
                break;
            }
        }

        $actuador->save();

        return back();
    }

}

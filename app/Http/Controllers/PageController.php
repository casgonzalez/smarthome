<?php

namespace App\Http\Controllers;

use App\Actuador;
use App\TblAlarma;
use App\Temperatura;
use Illuminate\Http\Request;

class PageController extends Controller
{

    public function dashboard() {

        $luzInterna = Actuador::find(1);
        $luzExterna = Actuador::find(2);
        $luzCuarto  = Actuador::find(3);

        $ventilador = Actuador::find(4);
        $clima      = Actuador::find(5);
        $porton     = Actuador::find(6);

        $temps = Temperatura::orderBy('id','DESC')->take(10)->get();
        $temperaturas = array();

        for($i=$temps->count(); $i>0; $i--) {
            $temperaturasArray = $temps->toArray();
            array_push($temperaturas,$temperaturasArray[$i-1]);
        };

        $latestTempAll = Temperatura::orderBy('id','DESC')->take(4)->get();

        return view('welcome',compact(
            'temperaturas',
            'luzInterna',
            'luzExterna',
            'luzCuarto',
            'ventilador',
            'clima',
            'porton'
        ));
    }

}

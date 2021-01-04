<?php

namespace App\Http\Controllers;

use App\Actuador;
use App\TblAlarma;
use App\Temperatura;
use Illuminate\Http\Request;

class PageController extends Controller
{

    public function dashboard() {

        /*for($i= 1; $i<=31; $i++) {
            $temperatura = new Temperatura();
            $temperatura->fecha = "2020-12-{$i}";
            $temperatura->temperatura = rand(20,35);
            $temperatura->save();
        }*/

        $actuadores = Actuador::orderBY('id','asc')->get();

        $temps = Temperatura::orderBy('id','DESC')->take(10)->get();
        $temperaturas = array();

        for($i=$temps->count(); $i>0; $i--) {
            $temperaturasArray = $temps->toArray();
            array_push($temperaturas,$temperaturasArray[$i-1]);
        };

        $latestTempAll = Temperatura::orderBy('id','DESC')->take(4)->get();

        return view('welcome',compact('actuadores','temperaturas'));
    }

}

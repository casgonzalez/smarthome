<?php

namespace App\Http\Controllers;

use App\Actuador;
use App\Notificacion;
use App\Observador;
use App\TblAlarma;
use App\Temperatura;
use App\Humedad;
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

        $alarmas    = Observador::join('actuators','observers.actuator_id','actuators.id')
            ->orderBy('observers.time','DESC')
            ->select(['actuators.actuator','observers.id','observers.time','next_state','observers.created_at','actuators.id as actuator_id'])->get();

        $temps = Temperatura::orderBy('id','DESC')->take(10)->get();
        $temperaturas = array();

        for($i=$temps->count(); $i>0; $i--) {
            $temperaturasArray = $temps->toArray();
            array_push($temperaturas,$temperaturasArray[$i-1]);
        };

        $lastTemp = Temperatura::orderBy('id','DESC')->take(1)->first();
        $lastHumedad = Humedad::orderBy('id','DESC')->take(1)->first();

        return view('welcome',compact(
            'temperaturas',
            'luzInterna',
            'luzExterna',
            'luzCuarto',
            'ventilador',
            'clima',
            'porton',
            'alarmas',
            'lastTemp',
            'lastHumedad'
        ));
    }

    public function notificaciones(Request $request) {

        $idntf = $request->id;

        if ($idntf != null) {
            $ntf = Notificacion::find($idntf);
            $ntf->is_view = 1;
            $ntf->save();
            return redirect('notificaciones');
        }
    
        $nts  = Notificacion::join('tbl_usuarios','notificacions.idUser','tbl_usuarios.idUsuario')
            ->join('actuators','notificacions.idActuador','actuators.id')
            ->select(
                'notificacions.state',
                'tbl_usuarios.nombre',
                'actuators.actuator',
                'actuators.id as idActuador',
                'notificacions.created_at'
            )
            ->orderBy('notificacions.id','DESC')
            ->get();

        return view('nts',compact('nts'));
    }

    public function deleteAlarm($idAlarm) 
    {
        Observador::find($idAlarm)->delete();
        return back();
    }

}

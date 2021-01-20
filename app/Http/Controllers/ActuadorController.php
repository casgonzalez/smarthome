<?php

namespace App\Http\Controllers;

use App\Actuador;
use App\Mail\ForzeDoorMail;
use App\Notificacion;
use App\Observador;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ActuadorController extends Controller
{


    public function forzarPuerta()
    {
        $porton = Actuador::find(6);
        $porton->state = 1;
        $porton->save();

        return back();
    }

    public function update(Request $request) {

        $idActuador = $request->idActuator;
        $next_state = $request->next_state;

        $actuador = Actuador::find($idActuador);
        $actuador->state = $next_state;
        $actuador->save();

        $notificaciones = new Notificacion();
        $notificaciones->idUser = Auth::user()->idUsuario;
        $notificaciones->idActuador  = $actuador->id;
        $notificaciones->state = $actuador->state;
        $notificaciones->save();

        return response()->json([
            'message' => $actuador->state == 0 ? 'La luz se a apagado' : 'La Luz se a prendido'
        ],200);

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

    public function observer() 
    {
        $porton = Actuador::find(6);

        $current_state = $porton->state;

        $latest_state  = Notificacion::where('idActuador',$porton->id)->first()->state;

        if ( $current_state == $latest_state )
        {
            return response()->json(['is_forced'=>0]);
        }else
        {
            return response()->json(['is_forced'=>1]);
        }
    }

    public function forceCloseNotification()
    {
        
        $porton = Actuador::find(6);
        
        try{
            // cerrar el porton forzado
            $porton->state = 0;
            $porton->save();

            $fecha = now();

            $userAdmin  = User::first();

            $mail = new ForzeDoorMail($fecha,$userAdmin);

            Mail::to($userAdmin->email)->send($mail);

            return response()->json(['mgs'=>'El correo ha sido enviado...'],200);

        }catch(\Exception $exception) {
            return response()->json(['msg'=>$exception->getMessage()],500);
        }

    }

    /* alarmas */

    public function observerAlarms($idActuador)
    {

        //
        $actuador = Actuador::findOrFail($idActuador);

        $ob = Observador::where('actuator_id',$actuador->id)
            ->whereRaw(DB::raw('now() >= time'))
            ->where('status',0)
            ->first();

        if (!$ob) {
            return response()->json(['msg'=>'Ninguna alarma agregada']);
        }

        if ($actuador->state == $ob->next_state) {
            $ob->status = 1;
            $ob->save();
            return response()->json(['msg'=>'El estado del actuador es igual al del estado del programado']);
        }

        $actuador->state = $ob->next_state;
        $actuador->save();

        $ob->status = 1;
        $ob->save();

        $idActuador = $actuador->id;
        $next_state = $ob->next_state;

        $notificaciones = new Notificacion();
        $notificaciones->idUser = 1;
        $notificaciones->idActuador  = $actuador->id;
        $notificaciones->state       = $actuador->state;
        $notificaciones->save();

        return response()->json(['mgs'=>'ok'],200);

    }

}

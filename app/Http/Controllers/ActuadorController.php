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

}

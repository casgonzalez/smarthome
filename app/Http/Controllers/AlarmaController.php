<?php

namespace App\Http\Controllers;

use App\TblAlarma;
use Illuminate\Http\Request;

class AlarmaController extends Controller
{


    function store(Request  $request) {

        $alarma = new TblAlarma();
        $alarma->time_end  = $request->end_time;
        $alarma->save();

        return back();

    }


}

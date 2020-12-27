<?php

namespace App\Http\Controllers;

use App\TblAlarma;
use Illuminate\Http\Request;

class PageController extends Controller
{

    public function dashboard() {

        $alarmas = TblAlarma::where('status',0)->get();

        return view('welcome',compact('alarmas'));
    }

}

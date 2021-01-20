<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Humedad;
class HumedadController extends Controller
{
    
    public function store(Request $request) 
    {

        $humedad = new Humedad();
        $humedad->valor = $request->valor;
        $humedad->save();

        return response()->json(['msg'=>'valor agregado correctamente'],201);
        
    }

}

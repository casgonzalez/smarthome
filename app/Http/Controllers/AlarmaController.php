<?php

namespace App\Http\Controllers;

use App\TblAlarma;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class AlarmaController extends Controller
{


    function store(Request  $request) {

        $alarma = new TblAlarma();
        $alarma->time_end  = $request->end_time;
        $alarma->save();

        return back();

    }

    function messsage() {

        $json = [
            'token'=>'e9faf9b447b6fb6cef9a31af3cf321b1',
            'source'=>'521961427273',
            'destination'=>'529611782523',
            'type'=>'text',
            'body'=>[
                'text'=>'Tu puerta se abrio'
            ]
        ];

        $client = new Client();

        $response = $client->request("POST","http://waping.es/api/send",
            [
                "headers"=>["Content-Type"=>"application/json"],
                "json"=>$json
            ]
        );

        dd($response->getStatusCode());

    }


}

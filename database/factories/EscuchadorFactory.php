<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Escuchador::class, function (Faker $faker) {
    $actuadores = \App\Actuador::all();
    $usuarios   = \App\User::all();

    $minDate = strtotime('2020-12-28');
    $maxDate = strtotime('2020-12-31');

    $val = rand($minDate, $maxDate);


    return [
        'idActuador'=>$actuadores->random(),
        'proximoEstado'=>rand(0,1),
        'tiempo' => date('Y-m-d H:i:s', $val),
        'idUsuario' => $usuarios->random(),
    ];
});

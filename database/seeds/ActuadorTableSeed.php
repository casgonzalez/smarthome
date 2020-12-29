<?php

use Illuminate\Database\Seeder;

class ActuadorTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $actuador = new \App\Actuador();
        $actuador->actuador = 'Luz Interna';
        $actuador->save();

        $actuador = new \App\Actuador();
        $actuador->actuador = 'Luz Externa';
        $actuador->save();

        $actuador = new \App\Actuador();
        $actuador->actuador = 'Ventilador';
        $actuador->save();

        $actuador = new \App\Actuador();
        $actuador->actuador = 'Clima';
        $actuador->save();
    }
}

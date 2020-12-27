<?php

use Illuminate\Database\Seeder;

class RolSeedTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rol = new \App\CatRol();
        $rol->rol = 'administrador';
        $rol->save();

        $rol = new \App\CatRol();
        $rol->rol = 'familiar';
        $rol->save();

        $rol = new \App\CatRol();
        $rol->rol = 'invitado';
        $rol->save();


    }
}

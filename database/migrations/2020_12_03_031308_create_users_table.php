<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_usuarios', function (Blueprint $table) {

            $table->increments('idUsuario');

            $table->string('nombre');
            $table->string('email')->unique();
            $table->string('password')->nullable();

            $table->integer('idRol')->unsigned()->default(2);

            $table->string('urlFotoPerfil')->default('/imagenes/icons/user-empty.png');

            $table->date('cuentaVerificada')->nullable();

            $table->tinyInteger('eliminado')->default(0);

            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}

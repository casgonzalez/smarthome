<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEscuchadorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('escuchadores', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idActuador')->unsigned();
            $table->foreign('idActuador')->references('id')->on('actuadores');
            $table->tinyInteger('proximoEstado')->unsigned();
            $table->dateTime('tiempo');
            $table->tinyInteger('eliminado')->default(0);
            $table->integer('idUsuario')->unsigned();
            $table->foreign('idUsuario')->references('idUsuario')->on('tbl_usuarios');
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
        Schema::dropIfExists('escuchadors');
    }
}

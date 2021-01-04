<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActuadorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actuadores', function (Blueprint $table) {
            $table->increments('id');
            $table->string('actuador');
            $table->string('icono');
            $table->integer('tamanio')->default(6);
            $table->integer('need_configuracion');
            $table->integer('configuracion')->default(0);
            $table->tinyInteger('eliminado')->default(0);
            $table->tinyInteger('estado')->default(0); // 0' => apagado 1 => encendido
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
        Schema::dropIfExists('actuadors');
    }
}

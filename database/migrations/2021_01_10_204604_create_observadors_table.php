<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObservadorsTable extends Migration
{

    public function up()
    {
        Schema::create('observers', function (Blueprint $table) {

            $table->id();

            $table->integer('actuator_id')->unsigned();
            $table->foreign('actuator_id')->references('id')->on('actuators');

            $table->integer('next_state');

            $table->datetime('time');

            $table->tinyInteger('status')->default(0);

            $table->timestamps();

        });
    }

    public function down()
    {
        Schema::dropIfExists('observadores');
    }

}

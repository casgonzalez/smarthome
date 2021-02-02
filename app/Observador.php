<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Observador extends Model
{

    protected $table = 'observers';

    public function timeRemaining()
    {
        $time = Carbon::make($this->time);
        return $time->diffForHumans();
    }

}

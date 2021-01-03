<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'tbl_usuarios';
    protected $primaryKey = 'idUsuario';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','eliminado'
    ];

    public function setPasswordAttribute($value) {
        $this->attributes['password'] = Hash::make($value);
    }

    public function getEliminadoAttribute($estatus) {
        return $estatus == 0 ?  'activo' : 'inactivo';
    }


    public function scopeGetUsersLike($query,$like) {
        return $query->where('nombre',"LIKE","%{$like}%")
            ->where('idUsuario','<>',Auth::user()->idUsuario)
            ->where('eliminado',0)
            ->orderBy('idUsuario','DESC');
    }

    public function isAdmin() {
        return $this->idRol == 1;
    }
}

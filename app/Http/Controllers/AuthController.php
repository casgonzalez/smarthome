<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function form() {
        return view('login.form');
    }

    public function login (Request $request) {

        try {
           $user = User::where('email',$request->email)->first();

           if ($user) {

               if (Hash::check($request->password,$user->password)) {
                   Auth::loginUsingId($user->idUsuario);
                   return redirect('/administracion/usuarios');
               }

           }

           return back();

        }catch (\Exception $exception) {

        }

    }

    public function logout() {

        Auth::logout();

        return redirect('/login');
    }

}

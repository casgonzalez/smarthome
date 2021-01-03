<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    function welcome (Request $request) {
        $user = new User();

        $user->email = $request->email;
        $user->password = $request->password;
        $user->idRol    = $request->idRol;
        $user->nombre   = $request->nombre;
        $user->save();

        Auth::loginUsingId($user->idUsuario);

        return redirect('administracion/usuarios');
    }
    public function form() {
        return view('login.form');
    }

    public function login (Request $request) {

        try {

            $user = User::where('email',$request->email)->first();

            if ($user) {

                if (Hash::check($request->password,$user->password)) {
                    Auth::loginUsingId($user->idUsuario);

                    if (Auth::user()->isAdmin() == 1) {
                        return redirect('/administracion/usuarios');
                    }
                    return redirect('/');
                }

            }

            return back()->withErrors(['email'=>trans('auth.failed')])->withInput();

        }catch (\Exception $exception) {

        }

    }

    public function logout() {

        Auth::logout();

        return redirect('/login');
    }

}

<?php

namespace App\Http\Controllers;

use App\Mail\UserStoreMail;
use App\Traits\UploadTrait;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class UsuariosController extends Controller
{

    use UploadTrait;

    public function index(Request $request) {
        $like = $request->like;
        $users = User::getUsersLike($like)->paginate(9);
        return view('administracion.usuarios.index',compact('users','like'));
    }

    public function create() {
        $user = new User();
        return view('administracion.usuarios.create',['user'=>$user]);
    }

    public function store(Request $request) {

        DB::beginTransaction();
        try {

            $user = new User();

            $user->nombre = $request->nombre;
            $user->email  = $request->email;
            $user->password = $request->password;

            $user->save();

            $mail = new UserStoreMail($user,$request->password);

            Mail::to($user->email)->send($mail);

            DB::commit();

            return back();

        }catch (\Exception $exception) {
            DB::rollBack();
            dd($exception);
        }

    }

    public function destroy($idUser){

        $user = User::findOrFail($idUser);

        $user->eliminado = $user->eliminado == 'activo' ? 1 : 0;
        $user->save();

        return back();

    }

    public function activateAccount(Request $request) {

        $email = $request->email;

        $user = User::where('email',$email)->first();

        if ($user) {
            $user->cuentaVerificada = now();
            $user->eliminado = 0;
            $user->save();

            Auth::loginUsingId($user->idUsuario);

        }
    }

    public function changeProfileImage(Request $request ) {

        try {

           if ($request->hasFile('profile')) {

               $user = User::findOrfail($request->idUsuario);

               $image = $request->file('profile');

               $name  = Str::slug($user->nombre).'_'.time();

               $folderName = '/profiles/';

               $filePath   = 'smarthomeImages/'.$folderName . $name . '.' .$image->getClientOriginalExtension();

               $this->uploadOne($image,$folderName,'public',$name);

               $user->urlFotoPerfil = $filePath;

               $user->save();


           }

           return back();





        }catch (\Exception $exception) {
            dd($exception);
        }

    }

}

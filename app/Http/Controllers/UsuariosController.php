<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStoreRequest;
use App\Mail\UserStoreMail;
use App\Mail\UserUpdateMail;
use App\Traits\UploadTrait;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class UsuariosController extends Controller
{

    use UploadTrait;

    public function profile() {
        $user = Auth::user();

        return view('profile',compact('user'));
    }
    public function index(Request $request) {
        $like = $request->like;
        $users = User::getUsersLike($like)->paginate(9);
        $user  = new User();
        return view('administracion.usuarios.index',compact('users','like','user'));
    }

    public function create() {
        $user = new User();
        return view('administracion.usuarios.create',['user'=>$user]);
    }

    public function store(UserStoreRequest $request) {


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
            return back()->with('status_warning',$exception->getMessage());
        }

    }

    public function update(Request $request,$idUser) {

        $request->validate([
            'nombre'=>'required',
            'email'=>['required']
        ]);

        DB::beginTransaction();
        try {


            $userToEdit = User::find($idUser);

            $user = User::where('email',$request->email)->first();


            if ($user && $userToEdit->email != $request->email) {
                return back()->with('status_warning','El correo electronico ya esta alamacenado');
            }

            $user = User::findOrFail($idUser);

            $previusEmail = $user->email;

            $user->nombre = $request->nombre;
            $user->email  = $request->email;

            $passwordUpdate = false;
            $password       = $request->password;



            if($request->password != null){
                $passwordUpdate = true;
                $user->password = $request->password;
            }

            $emailUpdated = $request->email == $user->email;

            $user->save();

            //mandar email unicamente si el correo fue actualizado o la contraseña fue actualizada
            if ($emailUpdated || $passwordUpdate == true) {
                $mail = new UserUpdateMail($user,$passwordUpdate,$password,$previusEmail);
                Mail::to($user->email)->send($mail);
            }

            DB::commit();

            return back()->with('status_success','Los datos han sido actualizados correctamente');

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

               $user = User::findOrFail(Auth::user()->idUsuario);

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

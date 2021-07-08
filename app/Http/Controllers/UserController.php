<?php

namespace App\Http\Controllers;

use App\Models\Suscriber;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
class UserController extends Controller{

    // public function destroy(){

    //     return redirect('/');
    // }
    public function settings(){

        if(isset($_SESSION['laravel_session'])){
            var_dump('SI EXISTO');
            die();
        }

        return view('user.settings');
    }

    public function changePassword()
    {
        return view('user.changePassword');
    }

    public function savePassword(Request $request){

        $user= Auth::user();

        
        $password = $request->get('oldPassword');
        $booleano = password_verify($password,$user->password);
        $newPassword = $request->get('password');

        $request->validate([
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);
        $sesion = '';

        var_dump($booleano);
        if($booleano){
            
            $sesion = 'The password has been reseted';
        
            
            $user->password =Hash::make($newPassword);
            $user->update();
        }else{
            $sesion = 'The password does not match with the old one';
        }

        return redirect('/changePassword')->with('password_validation', $sesion );
    }

    public function update(Request $request)
    {

        //OBTENIENDO MI USUARIO DE MI BASE DE DATOS

     
        $user = Auth::user();

        //VALIDANDO MIS VALORES
        $validated = $this->validate($request, array(
            'lastname' => 'required|string|max:255',
            'nick' => 'required|string|max:255|unique:users,nick,'.$user->id,
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
        ));

        //CACHANDO MIS VALORES DEL FORMULARIO
        $name = $request->get('name');
        $lastname = $request->get('lastname');
        $nick = $request->get('nick');
        $email = $request->get('email');
        $image = $request->file('image');

        //SUBIENDO IMAGEN

        if($image){
            //Poniendo el nombre unico
            $image_name = time().$image->getClientOriginalName();
            //Guardando en mi disco en mi carpeta Storage/app/users
            Storage::disk('users')->put($image_name, File::get($image));
            //Seteo del nombre de la imagen
            $user->image=$image_name;
        }

        $user->name = $name;
        $user->lastname = $lastname;
        $user->nick = $nick;
        $user->email = $email;

        $user->update();

        return redirect('/settings');
    }

    public function getImage($image_name){
        $file = Storage::disk('users')->get($image_name);
        return Response($file,200);
    }


    //PERFIL

    public function profile($id){

        $user = User::find($id);
        $suscri = Suscriber::where('suscriber_id',$id)->get();
        $s = Suscriber::all();
        return view('user.profile',array(
            'user' => $user,
            'suscriber' =>$suscri,
            'sus'=>$s
        ));
    }

    public function search($var){
      
        $users = User::where('name','LIKE','%'.$var.'%')->orWhere('nick','LIKE','%'.$var.'%')->orWhere('lastname','LIKE','%'.$var.'%')->paginate(5);
        return view('user.showUsers',['user'=>$users]);

    }
}

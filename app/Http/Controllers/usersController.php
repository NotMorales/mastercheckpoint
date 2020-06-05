<?php

namespace App\Http\Controllers;

use App\users;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class usersController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function miperfil(){
        $user = users::where('userId', Auth::user()->userId)->first();
        return view('perfil.miperfil', [
            'user' => $user
        ]);
    }
    public function cambiarPass(){
        $user = users::where('userId', Auth::user()->userId)->first();
        return view('perfil.cambiarPass', [
            'user' => $user
        ]);
    }
    public function actualizarPass(Request $request){
        $validate = $this->validate($request, [
            'password' => 'required',
            'newpassword' => 'required|min:5',
            'repassword' => 'required|same:newpassword'
        ]);

        $password = $request->input('password');
        $newpassword = $request->input('newpassword');
        $repassword = $request->input('repassword');

        $newpassword = Hash::make( $newpassword );

        if( Hash::check($password, Auth::user()->password) ){
            DB::table('users')
                ->where("userId", Auth::user()->userId)
                ->update(['password' => $newpassword]);
        }else{
            return redirect()->back()->with(['error' => 'Contraseña actual incorrecta']);
        }
        return redirect()->back()->with(['success' => 'Contraseña actualizada correctamente!']);
    }

    public function actualizarAvatar(Request $request)
    {
        $validate = $this->validate($request, [
            'Correo' => 'required', 'string', 'max:255',
            'Telefono' => 'required', 'numeric',
        ]);

        $Correo = $request->input('Correo');
        $Telefono = $request->input('Telefono');

        //imagen
        $Imagen = $request->file('Avatar');
        $ImagenName = "";
        if($Imagen){
            $ImagenName = time().$Imagen->getClientOriginalName();
            Storage::disk('users')->put($ImagenName, File::get($Imagen));
        }else{
            $ImagenName = Auth::user()->avatar;
        }

        DB::table('users')
            ->where("userId", Auth::user()->userId)
            ->update(['avatar' => $ImagenName, 'email' => $Correo]);

        DB::table('persona')
            ->where("personaId", Auth::user()->personaId)
            ->update(['telefono' => $Telefono]);


        return redirect()->route('inicio');
    }
    public function getImagen($filename)
    {
        $file = Storage::disk('users')->get($filename);
        return new Response($file, 200);
    }
}

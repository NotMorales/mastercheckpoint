<?php

namespace App\Http\Controllers;

use App\experienciaeducativa;
use App\experienciaestudiante;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class experienciaeducativaController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function crearexperiencia()
    {
        $permiso = Auth::user()->roleId;
        if( $permiso != 2 ){
            return redirect()->route('inicio');
        }
        return view('experiencia.crearExperiencia');
    }

    public function registrarexperiencia(Request $request)
    {
        $permiso = Auth::user()->roleId;
        if( $permiso != 2 ){ return redirect()->route('inicio' );}

        $validate = $this->validate($request, [
            'Nombre' => 'required', 'string', 'max:255',
            'Descripcion' => 'required', 'numeric', 'max:255',
        ]);

        $Nombre = $request->input('Nombre');
        $Descripcion = $request->input('Descripcion');
        $Color = $request->input('Color');

        //imagen
        $Imagen = $request->file('Imagen');
        $ImagenName = "";
        if($Imagen){
            $ImagenName = time().$Imagen->getClientOriginalName();
            Storage::disk('experiencia')->put($ImagenName, File::get($Imagen));
        }

        $docente = Auth::user()->userId;

        $idExperiencia = DB::table('experienciaeducativa')->insertGetId([
            'docenteId' => $docente,
            'nombreExperiencia' => $Nombre,
            'descripcion' => $Descripcion,
            'image' => $ImagenName,
            'color' => $Color
        ]);

        return redirect()->route('inicio');
    }

    public function verExperiencia($experiencia)
    {
        $permiso = Auth::user()->roleId;
        if( $permiso != 2 ){ return redirect()->route('inicio' );}
        $experiencia = experienciaeducativa::where('experienciaEducativaId', $experiencia)->first();
        if($experiencia->docenteId != Auth::user()->userId){return redirect()->route('inicio' );}
        return view('experiencia.experienciaDoc', [
            'experiencia'  => $experiencia
        ]);
    }
    public function misEstudiantes($experiencia)
    {
        $permiso = Auth::user()->roleId;
        if( $permiso != 2 ){ return redirect()->route('inicio' );}
        $experiencia = experienciaeducativa::where('experienciaEducativaId', $experiencia)->first();
        if($experiencia->docenteId != Auth::user()->userId){return redirect()->route('inicio' );}

        $estudiantes = experienciaestudiante::where('experienciaEducativaId', $experiencia->experienciaEducativaId)->get();
        return view('estudiantes.misEstudiantes', [
            'experiencia'  => $experiencia,
            'estudiantes' => $estudiantes
        ]);
    }

    // ESTUDIANTE
    public function verExperienciaEst($experiencia)
    {
        $permiso = Auth::user()->roleId;
        if( $permiso != 3 ){ return redirect()->route('inicio' );}
        $experiencia = experienciaeducativa::where('experienciaEducativaId', $experiencia)->first();
        $estudianteExperiencia = experienciaestudiante::where('experienciaEducativaId', $experiencia->experienciaEducativaId)
            ->where('userId', Auth::user()->userId)->first();
        if(!$estudianteExperiencia){return redirect()->route('inicio' );}

        return view('experiencia.experienciaEst', [
            'experiencia'  => $experiencia
        ]);
    }
    public function salonEst($experiencia)
    {
        $permiso = Auth::user()->roleId;
        if( $permiso != 3 ){ return redirect()->route('inicio' );}
        $experiencia = experienciaeducativa::where('experienciaEducativaId', $experiencia)->first();
        $estudianteExperiencia = experienciaestudiante::where('experienciaEducativaId', $experiencia->experienciaEducativaId)
            ->where('userId', Auth::user()->userId)->first();
        if(!$estudianteExperiencia){return redirect()->route('inicio' );}

        $estudiantes = experienciaestudiante::where('experienciaEducativaId', $experiencia->experienciaEducativaId)->get();

        return view('estudiantes.salonEst', [
            'experiencia'  => $experiencia,
            'estudiantes' => $estudiantes
        ]);
    }
    public function getImagen($filename)
    {
        $file = Storage::disk('experiencia')->get($filename);
        return new Response($file, 200);
    }
    public function editarExperiencia($experiencia)
    {
        $permiso = Auth::user()->roleId;
        if( $permiso != 2 ){ return redirect()->route('inicio' );}
        $experiencia = experienciaeducativa::where('experienciaEducativaId', $experiencia)->first();
        if(!$experiencia){ return redirect()->route('inicio' );}
        if($experiencia->docenteId != Auth::user()->userId){return redirect()->route('inicio' );}
        return view('experiencia.editarExperiencia', [
            'experiencia'  => $experiencia
        ]);
    }
    public function actualizarExperiencia(Request $request)
    {
        $validate = $this->validate($request, [
            'Nombre' => 'required', 'string', 'max:255',
            'Descripcion' => 'required', 'numeric', 'max:255',
        ]);

        $Nombre = $request->input('Nombre');
        $Descripcion = $request->input('Descripcion');
        $experiencia = $request->input('experiencia');
        $Color = $request->input('Color');


        $permiso = Auth::user()->roleId;
        if( $permiso != 2 ){ return redirect()->route('inicio' );}
        $experiencia = experienciaeducativa::where('experienciaEducativaId', $experiencia)->first();
        if(!$experiencia){ return redirect()->route('inicio' );}
        if($experiencia->docenteId != Auth::user()->userId){return redirect()->route('inicio' );}

        //imagen
        $Imagen = $request->file('profile_avatar');
        $ImagenName = "";
        if($Imagen){
            $ImagenName = time().$Imagen->getClientOriginalName();
            Storage::disk('experiencia')->put($ImagenName, File::get($Imagen));
        }else{
            $ImagenName = $experiencia->image;
        }

        DB::table('experienciaeducativa')
            ->where("experienciaEducativaId", $experiencia->experienciaEducativaId)
            ->update(['nombreExperiencia' => $Nombre, 'descripcion' => $Descripcion, 'image' => $ImagenName, 'color' => $Color]);

        return redirect()->route('verExperiencia', ['experiencia' => $experiencia->experienciaEducativaId] );
    }
}

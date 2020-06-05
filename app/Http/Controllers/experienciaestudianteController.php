<?php

namespace App\Http\Controllers;

use App\experienciaeducativa;
use App\experienciaestudiante;
use App\users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class experienciaestudianteController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function agregarEstudiante($experiencia)
    {
        $permiso = Auth::user()->roleId;
        if( $permiso != 2 ){ return redirect()->route('inicio' );}
        $experiencia = experienciaeducativa::where('experienciaEducativaId', $experiencia)->first();
        if($experiencia->docenteId != Auth::user()->userId){return redirect()->route('inicio' );}
        return view('estudiantes.agregarEstudiante', [
            'experiencia'  => $experiencia
        ]);
    }
    public function crearEstudiante(Request $request)
    {
        $permiso = Auth::user()->roleId;
        if( $permiso != 2 ){ return redirect()->route('inicio' );}
        $experiencia = $request->input('experiencia');
        $experiencia = experienciaeducativa::where('experienciaEducativaId', $experiencia)->first();
        if($experiencia->docenteId != Auth::user()->userId){return redirect()->route('inicio' );}

        $validate = $this->validate($request, [
            'Nombre'            => ['required', 'string', 'max:255'],
            'Paterno'           => ['required', 'string', 'max:255'],
            'Materno'           => ['required', 'string', 'max:255'],
            'Telefono'          => ['nullable', 'Numeric'],
            'Matricula'         => ['required', 'string', 'max:255'],
            'Correo'             => ['required', 'string', 'email', 'max:255'],
        ]);

        $Nombre = $request->input('Nombre');
        $Paterno = $request->input('Paterno');
        $Materno = $request->input('Materno');
        $Telefono = $request->input('Telefono');
        $Matricula = $request->input('Matricula');
        $Correo = $request->input('Correo');

        $estudiante = users::where('matricula', $Matricula)->first();

        if (!$estudiante) {
            $idPersona = DB::table('persona')->insertGetId([
                'nombre' => $Nombre,
                'apellidoPaterno' => $Paterno,
                'apellidoMaterno' => $Materno,
                'telefono' => $Telefono,
            ]);
            $idUsuario = DB::table('users')->insertGetId([
                'personaId' => $idPersona,
                'roleId' => 3,
                'matricula' => $Matricula,
                'email' => $Correo,
                'password' => Hash::make($Matricula),
            ]);
        } else {
            $idUsuario = $estudiante->userId;
        }

        $expeUser = DB::table('experienciaestudiante')->insertGetId([
            'experienciaEducativaId' => $experiencia->experienciaEducativaId,
            'userId' => $idUsuario,
        ]);

        $participacion = DB::table('participacion')->insertGetId([
            'experienciaEstudianteId' => $expeUser,
            'numeroParticipaciones' => 0,
        ]);

        $estudiantes = experienciaestudiante::where('experienciaEducativaId', $experiencia->experienciaEducativaId)->get();
        return view('estudiantes.misEstudiantes', [
            'experiencia'  => $experiencia,
            'estudiantes' => $estudiantes
        ]);
    }
    public function experienciasDocente($experiencia)
    {
        $permiso = Auth::user()->roleId;
        if( $permiso != 2 ){ return redirect()->route('inicio' );}
        $experiencia = experienciaeducativa::where('experienciaEducativaId', $experiencia)->first();
        if($experiencia->docenteId != Auth::user()->userId){return redirect()->route('inicio' );}

        $experienciasDocente = experienciaeducativa::where('docenteId', Auth::user()->userId)->get();
        return view('estudiantes.tomarEstudiantes', [
            'experiencia'  => $experiencia,
            'experienciasDocente' => $experienciasDocente
        ]);
    }
    public function tomarEstudiantes(Request $request)
    {
        $permiso = Auth::user()->roleId;
        if( $permiso != 2 ){ return redirect()->route('inicio' );}
        $experiencia = $request->input('experiencia');
        $experiencia = experienciaeducativa::where('experienciaEducativaId', $experiencia)->first();
        if($experiencia->docenteId != Auth::user()->userId){return redirect()->route('inicio' );}

        $validate = $this->validate($request, [
            'expe'            => ['required'],
        ]);

        $expe = $request->input('expe');

        $estudiantes = experienciaestudiante::where('experienciaEducativaId', $expe)->get();

        foreach($estudiantes as $estudiante){

            $oneEstudiante = experienciaestudiante::where('experienciaEducativaId', $experiencia->experienciaEducativaId)
                ->where('userId', $estudiante->userId)
                ->first();

            if (!$oneEstudiante) {
                $expeUser = DB::table('experienciaestudiante')->insertGetId([
                    'experienciaEducativaId' => $experiencia->experienciaEducativaId,
                    'userId' => $estudiante->userId,
                ]);
                $participacion = DB::table('participacion')->insertGetId([
                    'experienciaEstudianteId' => $expeUser,
                    'numeroParticipaciones' => 0,
                ]);
            }
        }

        $estudiantes = experienciaestudiante::where('experienciaEducativaId', $experiencia->experienciaEducativaId)->get();
        return view('estudiantes.misEstudiantes', [
            'experiencia'  => $experiencia,
            'estudiantes' => $estudiantes
        ])->with(['success' => 'Importacion exitosa!']);
    }
}

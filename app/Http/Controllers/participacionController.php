<?php

namespace App\Http\Controllers;

use App\experienciaeducativa;
use App\experienciaestudiante;
use App\participacion;
use App\tema;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class participacionController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function verParticipaciones($experiencia)
    {
        $permiso = Auth::user()->roleId;
        if( $permiso != 2 ){ return redirect()->route('inicio' );}
        $experiencia = experienciaeducativa::where('experienciaEducativaId', $experiencia)->first();
        if($experiencia->docenteId != Auth::user()->userId){return redirect()->route('inicio' );}

        $estudiantes = experienciaestudiante::where('experienciaEducativaId', $experiencia->experienciaEducativaId)->get();

        // SELECT e.userId, SUM(p.numeroParticipaciones) as total FROM experienciaestudiante e
        // INNER JOIN participacion p
        // ON e.experienciaEstudianteId = p.experienciaEstudianteId
        // where e.experienciaEducativaId = 1
        // GROUP BY e.userId
        $participaciones=experienciaestudiante::
            select( 'experienciaestudiante.userId', DB::raw('SUM(participacion.numeroParticipaciones) as total') )
            ->join('participacion', 'experienciaestudiante.experienciaEstudianteId',  'participacion.experienciaEstudianteId')
            ->where('experienciaestudiante.experienciaEducativaId',  $experiencia->experienciaEducativaId)
            ->groupBy('experienciaestudiante.userId')
            ->orderBy('total', 'desc')
            ->get();

        $max=experienciaestudiante::
            select('experienciaestudiante.userId', DB::raw('SUM(participacion.numeroParticipaciones) as total') )
            ->join('participacion', 'experienciaestudiante.experienciaEstudianteId',  'participacion.experienciaEstudianteId')
            ->where('experienciaestudiante.experienciaEducativaId',  $experiencia->experienciaEducativaId)
            ->groupBy('experienciaestudiante.userId')
            ->orderBy('total', 'desc')
            ->first();

        // var_dump($participaciones);die();

        return view('participaciones.verParticipaciones', [
            'experiencia'  => $experiencia,
            'estudiantes' => $estudiantes,
            'participaciones' => $participaciones,
            'max' => $max
        ]);
    }
    public function darParticipaciones($experiencia)
    {
        $permiso = Auth::user()->roleId;
        if( $permiso != 2 ){ return redirect()->route('inicio' );}
        $experiencia = experienciaeducativa::where('experienciaEducativaId', $experiencia)->first();
        if($experiencia->docenteId != Auth::user()->userId){return redirect()->route('inicio' );}

        $estudiantes = experienciaestudiante::where('experienciaEducativaId', $experiencia->experienciaEducativaId)->get();

        $tema = tema::where('experienciaEducativaId', $experiencia->experienciaEducativaId)
            ->where('fechaInicio', '<=', date('y-m-d') )
            ->where('fechaFin', '>=', date('y-m-d') )
            ->orderBy('fechaFin', 'desc')
            ->first();

        // fecha inicial, fecha, fecha fin
        // 15 abril, 17 abril, 20 abril
        // si FI < F & F < FF

        return view('participaciones.darParticipaciones', [
            'experiencia'  => $experiencia,
            'estudiantes' => $estudiantes,
            'tema' => $tema
        ]);
    }
    public function asignarParticipacion(Request $request)
    {
        $permiso = Auth::user()->roleId;
        if( $permiso != 2 ){ return redirect()->route('inicio' );}

        $validate = $this->validate($request, [
            'participacion' => 'required', 'numeric',
        ]);

        $estudiante = $request->input('estudiante');
        $tema = $request->input('tema');
        $participaciones = $request->input('participacion');


        $idparticipacion = DB::table('participacion')->insertGetId([
            'experienciaEstudianteId' => $estudiante,
            'temaId' => $tema,
            'numeroParticipaciones' => $participaciones,
        ]);
        $experiencia = experienciaestudiante::where('experienciaEstudianteId', $estudiante)->first();

        return redirect()->route('darParticipaciones',['experiencia' => $experiencia->experienciaEducativaId]);
    }
    public function detalleParticipaciones(Request $request)
    {
        $permiso = Auth::user()->roleId;
        if( $permiso != 2 ){ return redirect()->route('inicio' );}

        $estudiante = $request->input('estudiante');
        $experiencia = $request->input('experiencia');

        $experiencia = experienciaeducativa::where('experienciaEducativaId', $experiencia)->first();
        if($experiencia->docenteId != Auth::user()->userId){return redirect()->route('inicio' );}

        $estudianteExperiencia = experienciaestudiante::
            where('experienciaEducativaId', $experiencia->experienciaEducativaId)
            ->where('userId', $estudiante)
            ->first();

        $participaciones = participacion::
            where('experienciaEstudianteId', $estudianteExperiencia->experienciaEstudianteId)
            ->get();

        return view('participaciones.detalleParticipaciones', [
            'experiencia'  => $experiencia,
            'estudianteExperiencia' => $estudianteExperiencia,
            'participaciones' => $participaciones
        ]);
    }
    public function editarParticipacion($participacion)
    {
        $permiso = Auth::user()->roleId;
        if( $permiso != 2 ){ return redirect()->route('inicio' );}

        $participacion = participacion::
            where('participacionId', $participacion)
            ->first();

        $experiencia = experienciaeducativa::where('experienciaEducativaId', $participacion->experienciaestudiante->experienciaEducativaId)->first();
        if($experiencia->docenteId != Auth::user()->userId){return redirect()->route('inicio' );}

        $temas = tema::where('experienciaEducativaId', $experiencia->experienciaEducativaId)->get();

        return view('participaciones.editarParticipacion', [
            'experiencia'  => $experiencia,
            'participacion' => $participacion,
            'temas' => $temas
        ]);
    }
    public function guardarParticipacionCambio(Request $request)
    {
        $permiso = Auth::user()->roleId;
        if( $permiso != 2 ){ return redirect()->route('inicio' );}

        $validate = $this->validate($request, [
            'Participacion' => 'required', 'numeric',
        ]);

        $Tema = $request->input('Tema');
        $Participacion = $request->input('Participacion');
        $Motivo = $request->input('Motivo');
        $detalle = $request->input('detalle');

        $participacionAntes = participacion::where("participacionId", $detalle)->first();

        DB::table('participacion')
            ->where("participacionId", $detalle)
            ->update(['temaId' => $Tema, 'numeroParticipaciones' => $Participacion, 'descripcion' => $Motivo]);

        $detalleEstudiante = participacion::where("participacionId", $detalle)->first();

        DB::table('notificacion')->insert([
            'userId' => $detalleEstudiante->experienciaestudiante->userId,
            'userIdRemitente' => Auth::user()->userId,
            'notificacion' => '¡Te han cambiado tus participaciones!',
            'descripcion' => 'Tu maestro de ' . $detalleEstudiante->experienciaestudiante->experienciaeducativa->nombreExperiencia . ' modifico tus participaciones de ' . $participacionAntes->numeroParticipaciones . ' a ' . $Participacion . ' por el motivo de: ' . $Motivo,
            'estado' => '0',
        ]);

        return redirect()->route('detalleParticipacion', ['estudianteExp' => $detalleEstudiante->experienciaEstudianteId]);
    }

    public function detalleParticipacion($estudianteExp)
    {
        $permiso = Auth::user()->roleId;
        if( $permiso != 2 ){ return redirect()->route('inicio' );}

        $estudianteExperiencia = experienciaestudiante::
            where('experienciaEstudianteId', $estudianteExp)
            ->first();

        $experiencia = experienciaeducativa::
            where('experienciaEducativaId', $estudianteExperiencia->experienciaEducativaId)
            ->first();

        if($experiencia->docenteId != Auth::user()->userId){return redirect()->route('inicio' );}

        $participaciones = participacion::
            where('experienciaEstudianteId', $estudianteExperiencia->experienciaEstudianteId)
            ->get();

        return view('participaciones.detalleParticipaciones', [
            'experiencia'  => $experiencia,
            'estudianteExperiencia' => $estudianteExperiencia,
            'participaciones' => $participaciones
        ]);
    }
    //ESTUDIANTE
    public function verParticipacionesEst($experiencia)
    {
        $permiso = Auth::user()->roleId;
        if( $permiso != 3 ){ return redirect()->route('inicio' );}

        $estudiante = experienciaestudiante::
            where('userId', Auth::user()->userId)
            ->where('experienciaEducativaId', $experiencia)
            ->first();

        $experiencia = experienciaeducativa::
            where('experienciaEducativaId', $experiencia)
            ->first();

        if(!$estudiante){return redirect()->route('inicio' );}

        $participaciones = participacion::
            where('experienciaEstudianteId', $estudiante->experienciaEstudianteId)
            ->get();

        return view('participaciones.verParticipacionesEst', [
            'experiencia'  => $experiencia,
            'estudiante' => $estudiante,
            'participaciones' => $participaciones
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\experienciaeducativa;
use App\experienciaestudiante;
use App\listaasistencia;
use App\tema;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class listaasistenciaController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function misPaseLista($experiencia)
    {
        $permiso = Auth::user()->roleId;
        if( $permiso != 2 ){ return redirect()->route('inicio' );}
        $experiencia = experienciaeducativa::where('experienciaEducativaId', $experiencia)->first();
        if($experiencia->docenteId != Auth::user()->userId){return redirect()->route('inicio' );}

        $PasesLista = listaasistencia::where('experienciaEducativaId', $experiencia->experienciaEducativaId)->get();
        return view('listaAsistencia.paseLista', [
            'experiencia'  => $experiencia,
            'PasesLista' => $PasesLista
        ]);
    }
    public function nuevoLista($experiencia)
    {
        $permiso = Auth::user()->roleId;
        if( $permiso != 2 ){ return redirect()->route('inicio' );}
        $experiencia = experienciaeducativa::where('experienciaEducativaId', $experiencia)->first();
        if($experiencia->docenteId != Auth::user()->userId){return redirect()->route('inicio' );}

        return view('listaAsistencia.nuevoPaseLista', [
            'experiencia'  => $experiencia
        ]);
    }
    public function registrarPaseLista(Request $request)
    {
        $permiso = Auth::user()->roleId;
        if( $permiso != 2 ){ return redirect()->route('inicio' );}
        $experiencia = $request->input('experiencia');
        $experiencia = experienciaeducativa::where('experienciaEducativaId', $experiencia)->first();
        if($experiencia->docenteId != Auth::user()->userId){return redirect()->route('inicio' );}

        $validate = $this->validate($request, [
            'Fecha' => 'required | string | max:255',
            'start' => 'required',
            'end' => 'required',
            'Duracion' => 'required | numeric | digits_between:1,15',
        ]);

        $Fecha = $request->input('Fecha');
        $start = $request->input('start');
        $end = $request->input('end');
        $Duracion = $request->input('Duracion');

        $idPase = DB::table('listaasistencia')->insertGetId([
            'fecha' => $Fecha,
            'horaInicio' => $start,
            'horaFin' => $end,
            'duracion' => $Duracion,
            'estado' => '0',
            'experienciaEducativaId' => $experiencia->experienciaEducativaId,
        ]);

        $estudiantes = experienciaestudiante::where('experienciaEducativaId', $experiencia->experienciaEducativaId)->get();
        foreach ($estudiantes as $key => $value) {
            DB::table('listaasistenciaestudiante')->insert([
                'listaAsistenciaId' => $idPase,
                'userId' => $value->userId,
                'tipo' => '0',
            ]);
        }



        $PasesLista = listaasistencia::where('experienciaEducativaId', $experiencia->experienciaEducativaId)->get();
        return view('listaAsistencia.paseLista', [
            'experiencia'  => $experiencia,
            'PasesLista' => $PasesLista
        ]);
    }
    public function editarPaseLista($pase)
    {
        $permiso = Auth::user()->roleId;
        if( $permiso != 2 ){ return redirect()->route('inicio' );}
        $pase = listaasistencia::where('listaAsistenciaId', $pase)->first();
        $experiencia = experienciaeducativa::where('experienciaEducativaId', $pase->experienciaEducativaId)->first();
        if($experiencia->docenteId != Auth::user()->userId){return redirect()->route('inicio' );}

        return view('listaAsistencia.editarPaseLista', [
            'experiencia'  => $experiencia,
            'pase' => $pase
        ]);
    }
    public function guardarPaseLista(Request $request)
    {
        $permiso = Auth::user()->roleId;
        if( $permiso != 2 ){ return redirect()->route('inicio' );}
        $pase = $request->input('pase');
        $pase = listaasistencia::where('listaAsistenciaId', $pase)->first();
        $experiencia = experienciaeducativa::where('experienciaEducativaId', $pase->experienciaEducativaId)->first();
        if($experiencia->docenteId != Auth::user()->userId){return redirect()->route('inicio' );}

        $validate = $this->validate($request, [
            'Fecha' => 'required | string | max:255',
            'start' => 'required',
            'end' => 'required',
            'Duracion' => 'required | numeric | digits_between:1,15',
        ]);

        $Fecha = $request->input('Fecha');
        $start = $request->input('start');
        $end = $request->input('end');
        $Duracion = $request->input('Duracion');

        DB::table('listaasistencia')
            ->where("listaAsistenciaId", $pase->listaAsistenciaId)
            ->update(['fecha' => $Fecha, 'horaInicio' => $start, 'horaFin' => $end, 'duracion'=> $Duracion]);

        $PasesLista = listaasistencia::where('experienciaEducativaId', $experiencia->experienciaEducativaId)->get();
        return view('listaAsistencia.paseLista', [
            'experiencia'  => $experiencia,
            'PasesLista' => $PasesLista
        ]);
    }
}

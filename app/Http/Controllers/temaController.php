<?php

namespace App\Http\Controllers;

use App\experienciaeducativa;
use App\tema;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class temaController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function misTemas($experiencia)
    {
        $permiso = Auth::user()->roleId;
        if( $permiso != 2 ){ return redirect()->route('inicio' );}
        $experiencia = experienciaeducativa::where('experienciaEducativaId', $experiencia)->first();
        if($experiencia->docenteId != Auth::user()->userId){return redirect()->route('inicio' );}

        $temas = tema::where('experienciaEducativaId', $experiencia->experienciaEducativaId)->get();
        return view('temas.temas', [
            'experiencia'  => $experiencia,
            'temas' => $temas
        ]);
    }
    public function nuevoTema($experiencia)
    {
        $permiso = Auth::user()->roleId;
        if( $permiso != 2 ){ return redirect()->route('inicio' );}
        $experiencia = experienciaeducativa::where('experienciaEducativaId', $experiencia)->first();
        if($experiencia->docenteId != Auth::user()->userId){return redirect()->route('inicio' );}

        return view('temas.nuevoTema', [
            'experiencia'  => $experiencia
        ]);
    }
    public function registrartema(Request $request)
    {
        $permiso = Auth::user()->roleId;
        if( $permiso != 2 ){ return redirect()->route('inicio' );}
        $experiencia = $request->input('experiencia');
        $experiencia = experienciaeducativa::where('experienciaEducativaId', $experiencia)->first();
        if($experiencia->docenteId != Auth::user()->userId){return redirect()->route('inicio' );}

        $validate = $this->validate($request, [
            'Tema' => 'required', 'string', 'max:255',
            'start' => 'required',
            'end' => 'required',
        ]);

        $Tema = $request->input('Tema');
        $start = $request->input('start');
        $end = $request->input('end');


        $idTema = DB::table('tema')->insertGetId([
            'nombreTema' => $Tema,
            'fechaInicio' => $start,
            'fechaFin' => $end,
            'experienciaEducativaId' => $experiencia->experienciaEducativaId,
        ]);

        $experiencia = experienciaeducativa::where('experienciaEducativaId', $experiencia->experienciaEducativaId)->first();
        $temas = tema::where('experienciaEducativaId', $experiencia->experienciaEducativaId)->get();
        return view('temas.temas', [
            'experiencia'  => $experiencia,
            'temas' => $temas
        ]);
    }
    public function editarTema($tema)
    {
        $permiso = Auth::user()->roleId;
        if( $permiso != 2 ){ return redirect()->route('inicio' );}
        $tema = tema::where('temaId', $tema)->first();
        $experiencia = experienciaeducativa::where('experienciaEducativaId', $tema->experienciaEducativaId)->first();
        if($experiencia->docenteId != Auth::user()->userId){return redirect()->route('inicio' );}

        return view('temas.Editartema', [
            'experiencia'  => $experiencia,
            'tema' => $tema
        ]);
    }
    public function guardartema(Request $request)
    {
        $permiso = Auth::user()->roleId;
        if( $permiso != 2 ){ return redirect()->route('inicio' );}
        $temaid = $request->input('temaid');
        $tema = tema::where('temaId', $temaid)->first();
        $experiencia = experienciaeducativa::where('experienciaEducativaId', $tema->experienciaEducativaId)->first();
        if($experiencia->docenteId != Auth::user()->userId){return redirect()->route('inicio' );}

        $validate = $this->validate($request, [
            'Tema' => 'required', 'string', 'max:255',
            'start' => 'required',
            'end' => 'required',
        ]);

        $Tema = $request->input('Tema');
        $start = $request->input('start');
        $end = $request->input('end');


        DB::table('tema')
            ->where("temaId", $temaid)
            ->update(['nombreTema' => $Tema, 'fechaInicio' => $start, 'fechaFin' => $end]);

        $temas = tema::where('experienciaEducativaId', $experiencia->experienciaEducativaId)->get();
        return view('temas.temas', [
            'experiencia'  => $experiencia,
            'temas' => $temas
        ]);
    }
}

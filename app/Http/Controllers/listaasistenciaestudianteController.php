<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\experienciaeducativa;
use App\experienciaestudiante;
use App\listaasistencia;
use App\listaasistenciaestudiante;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class listaasistenciaestudianteController extends Controller
{
    public function verPaseLista($pase)
    {
        $permiso = Auth::user()->roleId;
        if( $permiso != 2 ){ return redirect()->route('inicio' );}
        $pase = listaasistencia::where('listaAsistenciaId', $pase)->first();
        $experiencia = experienciaeducativa::where('experienciaEducativaId', $pase->experienciaEducativaId)->first();
        if($experiencia->docenteId != Auth::user()->userId){return redirect()->route('inicio' );}
        $detallesPaseLista = listaasistenciaestudiante::where('listaAsistenciaId', $pase->listaAsistenciaId)->get();
        return view('detallePaseLista.verPaseLista', [
            'experiencia'  => $experiencia,
            'pase' => $pase,
            'detallesPaseLista' => $detallesPaseLista
        ]);
    }
    public function editarDetallePaseLista($detallePase)
    {
        $permiso = Auth::user()->roleId;
        if( $permiso != 2 ){ return redirect()->route('inicio' );}
        $detallesPaseLista = listaasistenciaestudiante::where('listaAsistenciaEstudianteId', $detallePase)->first();
        $experiencia = experienciaeducativa::where('experienciaEducativaId', $detallesPaseLista->listaasistencia->experienciaEducativaId)->first();
        if($experiencia->docenteId != Auth::user()->userId){return redirect()->route('inicio' );}
        $pase = listaasistencia::where('listaAsistenciaId', $detallesPaseLista->listaAsistenciaId)->first();
        return view('detallePaseLista.editarDetallePaseLista', [
            'experiencia'  => $experiencia,
            'pase' => $pase,
            'detallesPaseLista' => $detallesPaseLista
        ]);
    }
    public function guardarDetallePaseLista(Request $request)
    {
        $permiso = Auth::user()->roleId;
        if( $permiso != 2 ){ return redirect()->route('inicio' );}
        $detalle = $request->input('detalle');
        $detallesPaseLista = listaasistenciaestudiante::where('listaAsistenciaEstudianteId', $detalle)->first();
        $experiencia = experienciaeducativa::where('experienciaEducativaId', $detallesPaseLista->listaasistencia->experienciaEducativaId)->first();
        if($experiencia->docenteId != Auth::user()->userId){return redirect()->route('inicio' );}

        $validate = $this->validate($request, [
            'Motivo' => 'required', 'string', 'max:255',
        ]);

        $tipo = $request->input('tipo');
        $Motivo = $request->input('Motivo');

        DB::table('listaasistenciaestudiante')
            ->where("listaAsistenciaEstudianteId", $detalle)
            ->update(['tipo' => $tipo, 'descripcion' => $Motivo]);

        $pase = listaasistencia::where('listaAsistenciaId', $detallesPaseLista->listaAsistenciaId)->first();
        $detallesPaseLista = listaasistenciaestudiante::where('listaAsistenciaId', $pase->listaAsistenciaId)->get();
        return view('detallePaseLista.verPaseLista', [
            'experiencia'  => $experiencia,
            'pase' => $pase,
            'detallesPaseLista' => $detallesPaseLista
        ]);
    }
    public function ActivarPaseLista($pase)
    {
        $permiso = Auth::user()->roleId;
        if( $permiso != 2 ){ return redirect()->route('inicio' );}
        $pase = listaasistencia::where('listaAsistenciaId', $pase)->first();
        $experiencia = experienciaeducativa::where('experienciaEducativaId', $pase->experienciaEducativaId)->first();
        if($experiencia->docenteId != Auth::user()->userId){return redirect()->route('inicio' );}
        $detallesPaseLista = listaasistenciaestudiante::where('listaAsistenciaId', $pase->listaAsistenciaId)->get();

        if ($pase->estado == 0) {
            $estado = 1;
            $estudiantes = experienciaestudiante::where('experienciaEducativaId', $experiencia->experienciaEducativaId)->get();
            foreach ($estudiantes as $key => $value) {
                DB::table('notificacion')->insert([
                    'userId' => $value->userId,
                    'userIdRemitente' => $experiencia->docenteId,
                    'notificacion' => '¡Se ah activado un pase de lista!',
                    'descripcion' => 'Tu maestro ah activado una pase de lista para ' . $experiencia->nombreExperiencia . 'realiza el checking antes que este se cierre!',
                    'estado' => '0',
                ]);
            }
        } else {
            $estado = 0;
        }

        DB::table('listaasistencia')
            ->where("listaAsistenciaId", $pase->listaAsistenciaId)
            ->update(['estado' => $estado]);

        $pase = listaasistencia::where('listaAsistenciaId', $pase->listaAsistenciaId)->first();

        return view('detallePaseLista.verPaseLista', [
            'experiencia'  => $experiencia,
            'pase' => $pase,
            'detallesPaseLista' => $detallesPaseLista
        ]);
    }
    //ESUDIANTE
    public function paseListaEst($experiencia)
    {
        $permiso = Auth::user()->roleId;
        if( $permiso != 3 ){ return redirect()->route('inicio' );}
        $experiencia = experienciaeducativa::where('experienciaEducativaId', $experiencia)->first();
        $estudianteExperiencia = experienciaestudiante::where('experienciaEducativaId', $experiencia->experienciaEducativaId)
            ->where('userId', Auth::user()->userId)->first();
        if(!$estudianteExperiencia){return redirect()->route('inicio' );}

        $PasesLista = listaasistencia::where('experienciaEducativaId', $experiencia->experienciaEducativaId)->get();
        return view('listaAsistencia.paseListaEst', [
            'experiencia'  => $experiencia,
            'PasesLista' => $PasesLista
        ]);
    }
    public function checkEst($pase)
    {
        $permiso = Auth::user()->roleId;
        if( $permiso != 3 ){ return redirect()->route('inicio' );}
        $paseLista = listaasistencia::where('listaAsistenciaId', $pase)->first();
        $experiencia = experienciaeducativa::where('experienciaEducativaId', $paseLista->experienciaEducativaId)->first();
        $estudianteExperiencia = experienciaestudiante::where('experienciaEducativaId', $experiencia->experienciaEducativaId)
            ->where('userId', Auth::user()->userId)->first();
        if(!$estudianteExperiencia){return redirect()->route('inicio' );}

        $message = "Error al hacer el Check!";
        if($paseLista->estado == 1 ){
            DB::table('listaasistenciaestudiante')
                ->where("listaAsistenciaId", $paseLista->listaAsistenciaId)
                ->where("userId", Auth::user()->userId )
                ->update(['tipo' => 1]);
            $message = "Asistencia Correcta!";
        }

        return redirect()->route('paseListaEst', ['experiencia' => $experiencia->experienciaEducativaId])->with(['message' => $message]);
    }
}

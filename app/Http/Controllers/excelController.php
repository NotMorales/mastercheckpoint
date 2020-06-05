<?php

namespace App\Http\Controllers;

use Importer;
use App\experienciaeducativa;
use App\experienciaestudiante;
use App\users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class excelController extends Controller
{

    public function importarExcelEstudiantes($experiencia)
    {
        $permiso = Auth::user()->roleId;
        if( $permiso != 2 ){ return redirect()->route('inicio' );}
        $experiencia = experienciaeducativa::where('experienciaEducativaId', $experiencia)->first();
        if($experiencia->docenteId != Auth::user()->userId){return redirect()->route('inicio' );}

        return view('estudiantes.importarExcelEstudiante', [
            'experiencia' => $experiencia
        ]);
    }
    public function importExcel(Request $request)
    {

        $experiencia = $request->input('experiencia');
        $experiencia = experienciaeducativa::where('experienciaEducativaId', $experiencia)->first();
        if($experiencia->docenteId != Auth::user()->userId){return redirect()->route('inicio' );}

        $validate = $this->validate($request, [
            'excel' => 'required|max:500|mimes:xlsx,xls,csv'
        ]);

        if( $validate ){
            $excel = $request->file('excel');
            $dateTime = date('Ymd-His');
            $fileName = $dateTime . '-' . $excel->getClientOriginalName();
            $save = public_path('/upload/');
            $excel->move($save, $fileName);

            $archivoExcel = Importer::make('Excel');
            $archivoExcel->load($save.$fileName);
            $collection = $archivoExcel->getCollection();

            if(sizeof($collection[1]) == 6){
                for($row=1; $row<sizeof($collection); $row++){
                    try {

                        $estudiante = users::where('matricula', $collection[$row][3] )->first();
                        if (!$estudiante) {
                            $idPersona = DB::table('persona')->insertGetId([
                                'nombre' => $collection[$row][0],
                                'apellidoPaterno' => $collection[$row][1],
                                'apellidoMaterno' => $collection[$row][2],
                                'telefono' => $collection[$row][5],
                            ]);
                            $idUsuario = DB::table('users')->insertGetId([
                                'personaId' => $idPersona,
                                'roleId' => 3,
                                'matricula' => $collection[$row][3],
                                'email' => $collection[$row][4],
                                'password' => Hash::make( $collection[$row][3] ),
                            ]);
                        } else {
                            $idUsuario = $estudiante->userId;
                        }

                        $estudianteExperiencia = experienciaestudiante::where('experienciaEducativaId', $experiencia->experienciaEducativaId)
                            ->where('userId', $idUsuario)
                            ->first();

                        if (!$estudianteExperiencia) {
                            $expeUser = DB::table('experienciaestudiante')->insertGetId([
                                'experienciaEducativaId' => $experiencia->experienciaEducativaId,
                                'userId' => $idUsuario,
                            ]);
                            $participacion = DB::table('participacion')->insertGetId([
                                'experienciaEstudianteId' => $expeUser,
                                'numeroParticipaciones' => 0,
                            ]);
                        }

                    } catch (\Exception $e) {
                        return redirect()->back()
                            ->with(['message' => 'Mal informacion']);
                    }
                }
            }else{
                return redirect()->back()
                ->with(['message' => 'Importacion Erroenia']);
            }
        }else{
            return redirect()->back()
                ->with(['message' => 'Archivo NO conocido']);
        }
        return redirect()->back()
                ->with(['message' => 'Importacion Exitosa!']);
    }
}

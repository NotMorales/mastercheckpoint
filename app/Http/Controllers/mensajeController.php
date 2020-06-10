<?php

namespace App\Http\Controllers;

use App\mensaje;
use App\users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class mensajeController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function mensajes($mensaje)
    {
        $mensajesTem =  mensaje::select('userIdRemitente as userId')
        ->where('userId', Auth::user()->userId);

        $personas = mensaje::select('userId as userId')
        ->where('userIdRemitente', Auth::user()->userId)
            ->union($mensajesTem)
            ->groupBy('userId')
            ->get();

        $mensajeMostrar = mensaje::
            where([
                ['userId', Auth::user()->userId],
                ['userIdRemitente', $mensaje],])
            ->orWhere([
                ['userId', $mensaje],
                ['userIdRemitente', Auth::user()->userId],])
            ->orderBy('created_at', 'desc')
            ->get();
        if( count($mensajeMostrar) > 0 ){
            DB::table('mensaje')
                ->where("userIdRemitente", $mensaje)
                ->update(['estado' => 1]);
        }

        return view('mensajes.mensajes', [
            'mensajeMostrar'  => $mensajeMostrar,
            'personas'  => $personas
        ]);
    }
    public function enviarMensaje(Request $request)
    {
        $validate = $this->validate($request, [
            'Asunto' => 'required', 'string', 'max:255',
            'Mensaje' => 'required', 'string', 'max:255',
            'Destino' => 'required',
        ]);

        $Asunto = $request->input('Asunto');
        $Mensaje = $request->input('Mensaje');
        $personaDestino = $request->input('Destino');


        $idMensaje = DB::table('mensaje')->insertGetId([
            'userId' => $personaDestino,
            'userIdRemitente' => Auth::user()->userId,
            'titulo' => $Asunto,
            'mensaje' => $Mensaje,
            'fecha' => date('Y-m-d'),
            'estado' => 0
        ]);
        return redirect()->route('mensajes', ['mensaje' => $personaDestino ]);
    }
    public function nuevoMensaje()
    {
        $mensajesTem =  mensaje::select('userIdRemitente as userId')
        ->where('userId', Auth::user()->userId);

        $personas = mensaje::select('userId as userId')
        ->where('userIdRemitente', Auth::user()->userId)
            ->union($mensajesTem)
            ->groupBy('userId')
            ->get();

        return view('mensajes.nuevoMensaje', [
            'personas'  => $personas
        ]);
    }
    public function enviarNuevoMensaje(Request $request)
    {
        $validate = $this->validate($request, [
            'Asunto' => 'required', 'string', 'max:255',
            'Mensaje' => 'required', 'string', 'max:255',
            'Destino' => 'required',
        ]);

        $Asunto = $request->input('Asunto');
        $Mensaje = $request->input('Mensaje');
        $Destino = $request->input('Destino');

        $personaDestino = users::where('email', $Destino)->first();

        if($personaDestino === null){
            return redirect()->back()->with([
                'SSMensaje' => 'Esto correo no se encuentra registrado.',
                'Asunto' => $Asunto,
                'Mensaje' => $Mensaje,
                ]);
        }
        $idMensaje = DB::table('mensaje')->insertGetId([
            'userId' => $personaDestino->userId,
            'userIdRemitente' => Auth::user()->userId,
            'titulo' => $Asunto,
            'mensaje' => $Mensaje,
            'fecha' => date('Y-m-d'),
            'estado' => 0
        ]);
        return redirect()->route('mensajes', ['mensaje' => $personaDestino->userId ]);
    }
    public function verMensaje($mensaje)
    {
        $mensajeSelect = mensaje::where('mensajeId', $mensaje)->first();
        if($mensajeSelect->userId == Auth::user()->userId ){
            return redirect()->route('mensajes', ['mensaje' => $mensajeSelect->userIdRemitente ]);
        }else{
            return redirect()->route('mensajes', ['mensaje' => $mensajeSelect->userId ]);
        }

    }
}

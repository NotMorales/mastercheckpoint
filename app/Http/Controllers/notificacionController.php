<?php

namespace App\Http\Controllers;

use App\notificacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class notificacionController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function notificaciones($notificacion)
    {
        $notificacionMostrar = notificacion::where([
            ['userId', Auth::user()->userId],
            ['notificacionId', $notificacion],
            ])->first();

        if( $notificacionMostrar ){
            DB::table('notificacion')
                ->where("notificacionId", $notificacionMostrar->notificacionId)
                ->update(['estado' => 1]);
        }

        $notificaciones = notificacion::where('userId', Auth::user()->userId)->get();

        return view('notificaciones.notificaciones', [
            'notificaciones'  => $notificaciones,
            'notificacionMostrar'  => $notificacionMostrar
        ]);
    }
}

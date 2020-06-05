<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class notificacionController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function notificaciones($notificacion)
    {
        return view('notificaciones.notificaciones');
    }
}

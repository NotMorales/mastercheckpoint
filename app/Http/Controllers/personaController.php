<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class personaController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
}

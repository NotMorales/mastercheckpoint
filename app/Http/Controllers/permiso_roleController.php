<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class permiso_roleController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
}

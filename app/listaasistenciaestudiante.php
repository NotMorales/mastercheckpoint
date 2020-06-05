<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class listaasistenciaestudiante extends Model
{
    protected $table = 'listaasistenciaestudiante';
    protected $primaryKey = 'listaAsistenciaEstudianteId';

    //Relacion Muchos a Uno
    public function listaasistencia(){
        return $this->belongsTo('App\listaasistencia', 'listaAsistenciaId', 'listaAsistenciaId');
    }
    //Relacion Muchos a Uno
    public function user(){
        return $this->belongsTo('App\users', 'userId', 'userId');
    }
}

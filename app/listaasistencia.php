<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class listaasistencia extends Model
{
    protected $table = 'listaasistencia';
    protected $primaryKey = 'listaAsistenciaId';

    //Relacion Muchos a Uno
    public function experienciaeducativa(){
        return $this->belongsTo('App\experienciaeducativa', 'experienciaEducativaId', 'experienciaEducativaId');
    }
    //Relacion Uno a Mucho
    public function listaasistenciaestudiante(){
        return $this->hasMany('App\listaasistenciaestudiante', 'listaAsistenciaId', 'listaAsistenciaId');
    }
}

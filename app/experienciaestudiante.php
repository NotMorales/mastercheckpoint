<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class experienciaestudiante extends Model
{
    protected $table = 'experienciaestudiante';
    protected $primaryKey = 'experienciaEstudianteId';

    //Relacion Muchos a Uno
    public function experienciaeducativa(){
        return $this->belongsTo('App\experienciaeducativa', 'experienciaEducativaId', 'experienciaEducativaId');
    }
    //Relacion Muchos a Uno
    public function user(){
        return $this->belongsTo('App\users', 'userId', 'userId');
    }
    //Relacion Uno a Mucho
    public function listaasistenciaestudiante(){
        return $this->hasMany('App\listaasistenciaestudiante', 'listaAsistenciaId', 'listaAsistenciaId');
    }
}

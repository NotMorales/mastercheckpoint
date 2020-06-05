<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class experienciaeducativa extends Model
{
    protected $table = 'experienciaeducativa';
    protected $primaryKey = 'experienciaEducativaId';

    //Relacion Muchos a Uno
    public function docente(){
        return $this->belongsTo('App\users', 'docenteId', 'userId');
    }
    //Relacion Uno a Mucho
    public function experienciaestudiante(){
        return $this->hasMany('App\experienciaestudiante', 'experienciaEducativaId', 'experienciaEducativaId');
    }
    //Relacion Uno a Mucho
    public function tema(){
        return $this->hasMany('App\tema', 'experienciaEducativaId', 'experienciaEducativaId');
    }
    //Relacion Uno a Mucho
    public function listaasistencia(){
        return $this->hasMany('App\listaasistencia', 'experienciaEducativaId', 'experienciaEducativaId');
    }
}


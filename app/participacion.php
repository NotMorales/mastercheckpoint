<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class participacion extends Model
{
    protected $table = 'participacion';
    protected $primaryKey = 'participacionId';

    //Relacion Muchos a Uno
    public function experienciaestudiante(){
        return $this->belongsTo('App\experienciaestudiante', 'experienciaEstudianteId', 'experienciaEstudianteId');
    }
    //Relacion Muchos a Uno
    public function tema(){
        return $this->belongsTo('App\tema', 'temaId', 'temaId');
    }
}

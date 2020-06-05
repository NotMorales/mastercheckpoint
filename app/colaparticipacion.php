<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class colaparticipacion extends Model
{
    protected $table = 'colaparticipacion';
    protected $primaryKey = 'colaParticipacionId';

    //Relacion Muchos a Uno
    public function experienciaestudiante(){
        return $this->belongsTo('App\experienciaestudiante', 'experienciaEstudianteId', 'experienciaEstudianteId');
    }
}

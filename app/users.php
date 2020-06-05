<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class users extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'userId';

    //Relacion Muchos a Uno
    public function persona(){
        return $this->belongsTo('App\persona', 'personaId', 'personaId');
    }
    //Relacion Muchos a Uno
    public function role(){
        return $this->belongsTo('App\role', 'roleId', 'roleId');
    }
    //Relacion uno a muchos
    public function listaasistenciaestudiante(){
        return $this->hasMany('App\listaasistenciaestudiante','userId','userId');
    }
    //Relacion uno a muchos
    public function experienciaeducativa(){
        return $this->hasMany('App\experienciaeducativa','docenteId','userId');
    }
    //Relacion uno a muchos
    public function experienciaestudiante(){
        return $this->hasMany('App\experienciaestudiante','userId','userId');
    }
    //Relacion uno a muchos
    public function mensaje(){
        return $this->hasMany('App\mensaje','userId','userId');
    }
    //Relacion uno a muchos
    public function mensajeRemitente(){
        return $this->hasMany('App\mensaje','userIdRemitente','userId');
    }
    //Relacion uno a muchos
    public function notificacion(){
        return $this->hasMany('App\notificacion','userId','userId');
    }
    //Relacion uno a muchos
    public function notificacionRemitente(){
        return $this->hasMany('App\notificacion','userIdRemitente','userId');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tema extends Model
{
    protected $table = 'tema';
    protected $primaryKey = 'temaId';

    //Relacion Muchos a Uno
    public function experienciaeducativa(){
        return $this->belongsTo('App\experienciaeducativa', 'experienciaEducativaId', 'experienciaEducativaId');
    }
    //Relacion Uno a Mucho
    public function participacion(){
        return $this->hasMany('App\participacion', 'temaId', 'temaId');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mensaje extends Model
{
    protected $table = 'mensaje';
    protected $primaryKey = 'mensajeId';

    //Relacion Muchos a Uno
    public function users(){
        return $this->belongsTo('App\users', 'userId', 'userId');
    }
    //Relacion Muchos a Uno
    public function usersRemitente(){
        return $this->belongsTo('App\users', 'userIdRemitente', 'userId');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class notificacion extends Model
{
    protected $table = 'notificacion';
    protected $primaryKey = 'notificacionId';

    //Relacion Muchos a Uno
    public function users(){
        return $this->belongsTo('App\users', 'userId', 'userId');
    }
    //Relacion Muchos a Uno
    public function usersRemitente(){
        return $this->belongsTo('App\users', 'userIdRemitente', 'userId');
    }
}

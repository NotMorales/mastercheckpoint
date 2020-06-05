<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class permiso_role extends Model
{
    protected $table = 'permiso_role';
    protected $primaryKey = 'permiso_roleId';

    //Relacion Muchos a Uno
    public function permiso(){
        return $this->belongsTo('App\permiso', 'permisoId', 'permisoId');
    }
    //Relacion Muchos a Uno
    public function role(){
        return $this->belongsTo('App\role', 'roleId', 'roleId');
    }
}

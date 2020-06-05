<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class permiso extends Model
{
    protected $table = 'permiso';
    protected $primaryKey = 'permisoId';

    //Relacion uno a muchos
    public function permiso_role(){
        return $this->hasMany('App\permiso_role','permisoId','permisoId');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class role extends Model
{
    protected $table = 'role';
    protected $primaryKey = 'roleId';

    //Relacion uno a muchos
    public function permiso_role(){
        return $this->hasMany('App\permiso_role','roleId','roleId');
    }
}

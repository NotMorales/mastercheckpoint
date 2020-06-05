<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{

    use Notifiable;
    protected $primaryKey = 'userId';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'roleId', 'personaId', 'matricula', 'email', 'password', 'avatar',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    protected $table = 'users';

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

<?php

namespace Cinema;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'nombre', 'apellido', 'email', 'password','dni','telefono','id_tipo_usuario','deleted_at'
    ];

    public function tipo_usuario()
    {
        //return $this->belongsTo('Name of the model that is related to',"foreign key"-attribute");
        return $this->belongsTo('Cinema\TiposUsuarios',"id_tipo_usuario");

    }

    public function inscripciones()
    {
        return $this->hasMany('Cinema\Inscripcion');
    }

    public function novedades()
    {
        return $this->belongsToMany('Cinema\Novedad','users_novedades','id_usuario','id_novedad','id_inscripcion');
    }

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
}

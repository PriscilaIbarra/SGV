<?php

namespace Cinema;

use Illuminate\Database\Eloquent\Model;

class Asignatura extends Model
{
    protected $table = "asignaturas";

    protected $fillable = [
    	'id',
    	'descripcion',
    	'id_jefe_catedra_calificador'
    ];

    public function vacantes()
    {
    	return $this->hasMany('Cinema\Vacante');
    }


    public function JefeCatedra()
   	{
   		return $this->belongsTo('Cinema\User','id_jefe_catedra_calificador');
   	}
}

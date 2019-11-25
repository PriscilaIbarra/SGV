<?php

namespace Cinema;

use Illuminate\Database\Eloquent\Model;

class Asignatura extends Model
{
    protected $table = "asignaturas";

    protected $fillable = [
    	'id',
    	'descripcionnnn'
    ];

    public function vacantes()
    {
    	return $this->hasMany('Cinema\Vacante');
    }
}

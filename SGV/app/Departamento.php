<?php

namespace Cinema;

use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    protected $table = "departamentos";

    protected $fillable = [
    	'id',
    	'descripcion'
    ];

    public function vacantes()
    {
    	return $this->hasMany('Cinema\Vacante');
    }
}

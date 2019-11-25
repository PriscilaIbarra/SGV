<?php

namespace Cinema;

use Illuminate\Database\Eloquent\Model;

class Inscripcion extends Model
{
    protected $table ="inscripciones";

    protected $fillable = [
    	 				   'id',
    					   'fecha_generacion',
    					   'disponibilidad_horaria',
    					   'cv',
    					   'calificacion',
    					   'id_vacante',
    					   'id_usuario',
   						  ];
   						  
   	public function vacante()
   	{
   		return $this->belongsTo('Cinema\Vacante','id_vacante');
   	}					  

   	public function user()
   	{
   		return $this->belongsTo('Cinema\User','id_usuario');
   	}
}

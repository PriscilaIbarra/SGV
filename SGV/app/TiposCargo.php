<?php

namespace Cinema;

use Illuminate\Database\Eloquent\Model;

class TiposCargo extends Model
{
    protected $table = "tipos_cargos";

    protected $fillable = [
    	'id',
    	'descripcion',
    	'estado',        
    ];

    public function vacantes()
    {
      return $this->hasMany('Cinema\Vacante');
    }

    
}

<?php

namespace Cinema;

use Illuminate\Database\Eloquent\Model;

class Constancia extends Model
{
    
    protected $table = "constancias";

    protected $fillable = [
    	'id',
    	'ruta',
    	'id_orden',

    ];


	public function orden()
	{
	   		return $this->belongsTo('Cinema\OrdenMerito','id_orden');
	}

}

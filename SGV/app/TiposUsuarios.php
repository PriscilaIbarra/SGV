<?php

namespace Cinema;

use Illuminate\Database\Eloquent\Model;

class TiposUsuarios extends Model
{
    protected $table = "tipos_usuarios";
    
    protected $fillabel = [
    						'id',
    						'descripcion',
    						'deleted_at'
    					  ];
    
    public function users()
    {
    	return $this->hasMany('Cinema\User');
    }					  

}

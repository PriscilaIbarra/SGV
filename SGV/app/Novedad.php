<?php

namespace Cinema;

use Illuminate\Database\Eloquent\Model;

class Novedad extends Model
{
    protected $table = "novedads";

    protected $fillable = [
        'id',
        'descripcion'
    ];

    public function users()
    {
    	return $this->belongsToMany('Cinema\User');
    }
}

<?php

namespace Cinema;

use Illuminate\Database\Eloquent\Model;

class OrdenMerito extends Model
{
    protected $fillable = ['id', 'numero', 'estado', 'id_jefe_catedra', 'created_at','updated_at'
    ];    

}

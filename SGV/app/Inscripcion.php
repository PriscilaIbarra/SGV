<?php

namespace Cinema;

use Illuminate\Database\Eloquent\Model;

class Inscripcion extends Model
{
    protected $fillable = [
        'nombre', 'apellido', 'dni', 'email','id_tipo_usuario'
    ];
}

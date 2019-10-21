<?php

namespace Cinema;

use Illuminate\Database\Eloquent\Model;

class Vacante extends Model
{

  protected $table = "vacantes";

  protected $fillable = ['id','fecha_apertura','fecha_cierre','requisitos','adicionales','presentacion','horario','estado','id_asignatura','id_tipo_cargo','id_departamento','id_usuario','deleted_at'];

  public function asignatura()
  {
    return $this->belongsTo('Cinema\Asignatura');
  }

  public function tipo_cargo()
  {
    return $this->belongsTo('Cinema\TiposCargo');
  }

  public function departamento()
  {
    return $this->belongsTo('Cinema\Departamento');
  }

  public function user()
  {
    return $this->belongsTo('Cinema\User');
  }
  
}

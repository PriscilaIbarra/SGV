<?php

namespace Cinema;

use Illuminate\Database\Eloquent\Model;

class Vacante extends Model
{

  protected $table = "vacantes";

  protected $fillable = ['id','fecha_apertura','fecha_cierre','requisitos','adicionales','presentacion','horario','estado','id_asignatura','id_tipo_cargo','id_departamento','id_usuario','deleted_at'];

  public function asignatura()
  {
    return $this->belongsTo('Cinema\Asignatura','id_asignatura');
  }

  public function tipo_cargo()
  {
    return $this->belongsTo('Cinema\TiposCargo','id_tipo_cargo');
  }

  public function departamento()
  {
    return $this->belongsTo('Cinema\Departamento','id_departamento');
  }

  public function inscripciones()
  {

    return $this->hasMany('Cinema\Inscripcion');
  
  }  

  public function user()
  {
    return $this->belongsTo('Cinema\User','id_usuario');
  }
  
}

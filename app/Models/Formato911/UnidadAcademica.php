<?php

namespace App\Models\Formato911;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnidadAcademica extends Model
{
  use HasFactory;

  protected $connection = 'mysql_formato911';
  protected $table = 'mieg_unidades_academicas';
  protected $fillable = [
    'id_municipio',
    'id_unidad_dependencia',
    'id_tipo',
    'clave',
    'created_at',
    'updated_at',
    'deleted_at',
    'status'
  ];

  public function personalAdministrativo()
  {
    return $this->hasOne('App\Models\Formato911\PersonalAdministrativo', 'unidad_academica_id', 'id');
  }

  public function personalDocente()
  {
    return $this->hasOne('App\Models\Formato911\PersonalDocente', 'unidad_academica_id', 'id');
  }

  public function personalDocenteAntiguedad()
  {
    return $this->hasOne('App\Models\Formato911\PersonalDocenteAntiguedad', 'unidad_academica_id', 'id');
  }

  public function tipoUnidadAcademica()
  {
    return $this->belongsTo('App\Models\Formato911\UnidadAcademicaTipo', 'tipo_id', 'id');
  }

  public function unidadDependencia()
  {
    return $this->belongsTo('App\Models\Formato911\UnidadDependencia', 'unidad_dependencia_id', 'id');
  }

  public function municipio()
  {
    return $this->belongsTo('App\Models\Formato911\Municipio');
  }
}

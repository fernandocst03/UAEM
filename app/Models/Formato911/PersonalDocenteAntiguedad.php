<?php

namespace App\Models\Formato911;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonalDocenteAntiguedad extends Model
{
  use HasFactory;

  protected $table = 'mieg_formato911_personal_docente_antiguedad';
  protected $fillable = [
    'anio',
    'grupo_id',
    'unidad_academica_id',
    'hombres',
    'mujeres',
    'total',
    'status',
    'created_at',
    'updated_at',
    'deleted_at'
  ];

  public function unidadAcademica()
  {
    return $this->belongsTo('App\Models\Formato911\UnidadAcademica', 'unidad_academica_id', 'id');
  }

  public function antiguedadGrupo()
  {
    return $this->belongsTo('App\Models\Formato911\AntiguedadGrupo', 'grupo_id', 'id');
  }
}

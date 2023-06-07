<?php

namespace App\Models\Formato911;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonalDocenteEdad extends Model
{
  use HasFactory;

  protected $table = 'mieg_formato911_personal_docente_edad';
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

  public function edadGrupo()
  {
    return $this->belongsTo('App\Models\Formato911\EdadGrupo', 'grupo_id', 'id');
  }

  // scope
  public function scopeUnidad($query, $unidad)
  {
    if ($unidad) {
      return $query->where('unidad_academica_id', $unidad);
    }
  }

  public function scopeAnio($query, $anio)
  {
    if ($anio) {
      return $query->where('anio', $anio);
    }
  }
}

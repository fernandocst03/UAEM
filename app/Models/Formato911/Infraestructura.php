<?php

namespace App\Models\Formato911;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Infraestructura extends Model
{
  use HasFactory;

  protected $table = 'mieg_formato911_infraestructura';
  protected $fillable = [
    'anio',
    'unidad_academica_id',
    'inmueble_tipo_id',
    'aula_tipo_id',
    'aulas_existentes',
    'aulas_en_uso',
    'aulas_adaptadas',
    'talleres_existentes',
    'talleres_en_uso',
    'talleres_adaptados',
    'laboratorios_existentes',
    'laboratorios_en_uso',
    'laboratorios_adaptados',
    'laboratorios_computo',
    'biblioteca'
  ];

  public function unidadAcademica()
  {
    return $this->belongsTo('App\Models\formato911\UnidadAcademica', 'unidad_academica_id', 'id');
  }

  public function tipoPropiedad()
  {
    return $this->belongsTo('App\Models\formato911\InfraestructuraInmueblePropiedad', 'aula_tipo_id', 'id');
  }

  public function tipoConstruccion()
  {
    return $this->belongsTo('App\Models\formato911\InfraestructuraInmuebleConstruccion', 'inmueble_tipo_id', 'id');
  }

  // Scope
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

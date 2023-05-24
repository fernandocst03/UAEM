<?php

namespace App\Models\Formato911;

use App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonalAdministrativo extends Model
{
  use HasFactory;
  protected $connection = 'mysql_formato911';
  protected $table = 'mieg_formato911_personal_administrativo';
  protected $fillable = [
    'unidad_academica_id',
    'anio',
    'directivo_h',
    'directivo_m',
    'directivo_t',
    'docente_h',
    'docente_m',
    'docente_t',
    'docente_investigador_h',
    'docente_investigador_m',
    'docente_investigador_t',
    'investigador_h',
    'investigador_m',
    'investigador_t',
    'auxiliar_investigador_h',
    'auxiliar_investigador_m',
    'auxiliar_investigador_t',
    'administrativo_h',
    'administrativo_m',
    'administrativo_t',
    'otros_h',
    'otros_m',
    'otros_t',
    'status',
    'created_at',
    'updated_at',
    'deleted_at'
  ];

  public function unidadAcademica()
  {
    return $this->belongsTo('App\Models\Formato911\UnidadAcademica', 'unidad_academica_id', 'id');
  }
}

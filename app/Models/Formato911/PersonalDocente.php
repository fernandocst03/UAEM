<?php

namespace App\Models\Formato911;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonalDocente extends Model
{
  use HasFactory;

  protected $table = 'mieg_formato911_personal_docente';
  protected $fillable = [
    'unidad_academica_id',
    'anio',
    'pitc_h',
    'pitc_m',
    'pitc_t',
    'p34t_h',
    'p34t_m',
    'p34t_t',
    'pmt_h',
    'pmt_m',
    'pmt_t',
    'pph_h',
    'pph_m',
    'pph_t',
    'status'
  ];

  public function unidadAcademica()
  {
    return $this->belongsTo('App\Models\Formato911\UnidadAcademica', 'unidad_academica_id', 'id');
  }
}

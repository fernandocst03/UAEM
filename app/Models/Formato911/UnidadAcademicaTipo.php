<?php

namespace App\Models\Formato911;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnidadAcademicaTipo extends Model
{
  use HasFactory;

  protected $connection = 'mysql_formato911';
  protected $table = 'mieg_unidad_academica_tipo';
  protected $fillable = [
    'id',
    'tipo'
  ];

  public function unidadAcademica()
  {
    return $this->hasOne('App\Models\Formato911\UnidadAcademica', 'tipo_id', 'id');
  }
}

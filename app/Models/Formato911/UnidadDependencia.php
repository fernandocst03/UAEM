<?php

namespace App\Models\Formato911;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnidadDependencia extends Model
{
  use HasFactory;

  protected $connection = 'mysql_formato911';
  protected $table = 'sipei_unidades_dependencias';
  protected $fillable = [
    'id',
    'unidad_dependencia'
  ];

  public function unidadAcademica()
  {
    return $this->hasOne('App\Models\Formato911\UnidadAcademica', 'unidad_dependencia_id', 'id');
  }
}

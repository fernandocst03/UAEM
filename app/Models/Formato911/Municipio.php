<?php

namespace App\Models\Formato911;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
  use HasFactory;

  protected $connection = 'mysql_formato911';
  protected $table = 'mieg_municipios';
  protected $fillable = [
    'id',
    'campus_id',
    'municipio'
  ];

  public function unidadAcademica()
  {
    return $this->hasOne('App\Models\Formato911\UnidadAcademica');
  }

  public function campus()
  {
    return $this->belongsTo('App\Models\Formato911\Campus', 'campus_id', 'id');
  }
}

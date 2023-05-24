<?php

namespace App\Models\Formato911;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AntiguedadGrupo extends Model
{
  use HasFactory;

  protected $connection = 'mysql_formato911';
  protected $table = 'mieg_formato911_personal_docente_antiguedad_grupos';
  protected $fillable = [
    'id',
    'grupo'
  ];

  public function personalDocenteAntiguedad()
  {
    return $this->hasOne('App\Models\Formato911\PersonalDocenteAntiguedad', 'grupo_id', 'id');
  }
}

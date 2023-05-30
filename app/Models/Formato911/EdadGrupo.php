<?php

namespace App\Models\Formato911;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EdadGrupo extends Model
{
  use HasFactory;

  protected $table = 'mieg_formato911_personal_docente_edad_grupos';
  protected $fillable = [
    'id',
    'grupo'
  ];

  public function personalDocenteEdad()
  {
    return $this->hasOne('App\Models\Formato911\PersonalDocenteEdad', 'grupo_id', 'id');
  }
}

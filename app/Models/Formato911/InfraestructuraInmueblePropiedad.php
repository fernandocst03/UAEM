<?php

namespace App\Models\Formato911;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InfraestructuraInmueblePropiedad extends Model
{
  use HasFactory;

  protected $table = 'mieg_formato911_infraestructura_inmueble_propiedad';
  protected $fillable = [
    'id',
    'tipo'
  ];

  public function infraestructura()
  {
    return $this->hasOne('App\Models\formato911\Infraestructura', 'aula_tipo_id', 'id');
  }
}

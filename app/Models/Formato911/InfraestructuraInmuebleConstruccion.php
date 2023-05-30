<?php

namespace App\Models\Formato911;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InfraestructuraInmuebleConstruccion extends Model
{
  use HasFactory;

  protected $table = 'mieg_formato911_infraestructura_inmueble_construccion';
  protected $fillable = [
    'id',
    'tipo'
  ];

  public function infraestructura()
  {
    return $this->hasOne('App\Models\formato911\Infraestrutura', 'inmueble_tipo_id', 'id');
  }
}

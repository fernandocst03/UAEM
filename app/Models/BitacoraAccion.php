<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BitacoraAccion extends Model
{
  use HasFactory;

  protected $table = 'bitacora_acciones';

  protected $fillable = [
    'accion'
  ];

  public function bitacora()
  {
    return $this->hasOne('App\Models\AcuerdosCU\Bitacora', 'accion_id', 'id');
  }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bitacora extends Model
{
  use HasFactory;
  protected $table = 'bitacoras';
  protected $fillable = [
    'accion_id',
    'user_id',
    'fecha',
    'seccion',
    'registro_id',
    'registro_anterior',
    'registro_nuevo'
  ];

  public function tipoBitacora()
  {
    return $this->belongsTo('App\Models\BitacoraAccion', 'accion_id', 'id');
  }

  public function user()
  {
    return $this->belongsTo('App\Models\User', 'user_id', 'id');
  }

  // Scope
  public function scopeFecha($query, $fecha_inicio, $fecha_fin)
  {
    if ($fecha_inicio  && $fecha_fin)
      return $query->whereBetween('fecha', [$fecha_inicio, $fecha_fin]);
  }

  public function scopeAccion($query, $accion)
  {
    if ($accion)
      return $query->where('accion_id', $accion);
  }
}

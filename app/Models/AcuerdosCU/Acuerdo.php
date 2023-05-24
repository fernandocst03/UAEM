<?php

namespace App\Models\AcuerdosCU;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Acuerdo extends Model
{
  use HasFactory;
  protected $table = 'acuerdos';
  protected $fillable = [
    'sesion_id',
    'acuerdo_tipo_id',
    'tipo_otro',
    'punto',
    'acuerdo',
    'acuerdo_corto',
    'observaciones',
    'pagina_samara',
    'created_at',
    'updated_at'
  ];

  public function tipoAcuerdo()
  {
    return $this->belongsTo('App\Models\AcuerdosCU\AcuerdoTipo', 'acuerdo_tipo_id', 'id');
  }

  public function sesion()
  {
    return $this->belongsTo('App\Models\AcuerdosCU\Sesion', 'sesion_id', 'id');
  }

  // Scope
  public function scopeFecha($query, $fecha_inicio, $fecha_fin)
  {
    if ($fecha_inicio  && $fecha_fin)
      return $query->whereBetween('sesiones.fecha', [$fecha_inicio, $fecha_fin]);
  }

  public function scopeTipo($query, $tipo)
  {
    if ($tipo)
      return $query->where('acuerdo_tipo_id', $tipo);
  }
}

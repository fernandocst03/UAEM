<?php

namespace App\Models\AcuerdosCU;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sesion extends Model
{
  use HasFactory;
  protected $table = 'sesiones';
  protected $fillable = [
    'fecha',
    'tipo_id'
  ];

  public function samarasesion()
  {
    return $this->hasOne('App\Models\AcuerdosCU\SamaraSesion');
  }

  public function sesionTipo()
  {
    return $this->belongsTo('App\Models\AcuerdosCU\SesionTipo', 'tipo_id');
  }

  public function acuerdos()
  {
    return $this->hasMany('App\Models\AcuerdosCU\Acuerdo');
  }
}

<?php

namespace App\Models\AcuerdosCU;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SamaraSesion extends Model
{
  use HasFactory;
  protected $table = 'samara_sesiones';
  protected $fillable = [
    'samara_id',
    'sesion_id'
  ];

  public function samara()
  {
    return $this->belongsTo('App\Models\AcuerdosCU\Samara');
  }

  public function sesion()
  {
    return $this->belongsTo('App\Models\AcuerdosCU\Sesion');
  }
}

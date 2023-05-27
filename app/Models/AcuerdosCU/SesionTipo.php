<?php

namespace App\Models\AcuerdosCU;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SesionTipo extends Model
{
  use HasFactory;
  protected $table = 'sesion_tipos';
  protected $fillable = [''];

  public function sesion()
  {
    return $this->hasOne('App\Models\AcuerdosCU\Sesion', 'tipo_id');
  }
}

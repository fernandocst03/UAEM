<?php

namespace App\Models\AcuerdosCU;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcuerdoTipo extends Model
{
  use HasFactory;
  protected $table = 'acuerdo_tipos';
  protected $fillable = [''];


  public function acuerdo()
  {
    return $this->hasOne('App\Models\AcuerdosCU\Acuerdo', 'acuerdo_tipo_id', 'id');
  }
}

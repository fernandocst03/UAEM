<?php

namespace App\Models\AcuerdosCU;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rectorado extends Model
{
  use HasFactory;

  protected $fillable = [
    'id',
    'ciclo',
  ];

  protected $table = 'Rectorados';

  public function samaras()
  {
    return $this->hasMany('App\Models\AcuerdosCU\Samara');
  }
}

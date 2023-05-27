<?php

namespace App\Models\AcuerdosCU;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Samara extends Model
{
  use HasFactory;
  protected $table = 'samaras';
  protected $fillable = [
    'anio',
    'fecha',
    'numero',
    'rectorado_id',
    'url_archivo'
  ];

  public function rectorado()
  {
    return $this->belongsTo('App\Models\AcuerdosCU\Rectorado');
  }

  public function samarasesion()
  {
    return $this->hasMany('App\Models\AcuerdosCU\SamaraSesion', 'samara_id');
  }
}

<?php

namespace App\Models\Formato911;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campus extends Model
{
  use HasFactory;

  protected $table = 'mieg_campo';
  protected $fillable = [
    'id',
    'campus'
  ];

  public function municipio()
  {
    return $this->hasOne('App\Models\Formato911\Municipio', 'campus_id', 'id');
  }
}

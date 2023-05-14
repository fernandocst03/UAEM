<?php

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\AcuerdosCU\Bitacora;
use App\Models\AcuerdosCU\Sesion;
use Carbon\Carbon;

function bitacora($accion_id, $seccion, $registro_id, $old_value = null, $new_value = null)
{
  $fecha = Carbon::now();
  $bitacora = Bitacora::create([
    'accion_id' => $accion_id,
    'user_id' => Auth::user()->id,
    'fecha' => $fecha,
    'seccion' => $seccion,
    'registro_id' => $registro_id,
    'old_value' => $old_value,
    'new_value' => $new_value
  ]);
}

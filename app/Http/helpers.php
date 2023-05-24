<?php

use Illuminate\Support\Facades\Auth;
use App\Models\Bitacora;
use Carbon\Carbon;

function bitacora($accionId, $seccion, $registroId, $oldValue = null, $newValue = null)
{
  $fecha = Carbon::now();
  $bitacora = Bitacora::create([
    'accion_id' => $accionId,
    'user_id' => Auth::user()->id,
    'fecha' => $fecha,
    'seccion' => $seccion,
    'registro_id' => $registroId,
    'old_value' => $oldValue,
    'new_value' => $newValue
  ]);
}

<?php

namespace App\Http\Controllers;

use App\Models\Bitacora;
use Illuminate\Http\Request;
use App\Models\BitacoraAccion;

class ReporteBitacoraController extends Controller
{
  public function __invoke(Request $request)
  {
    $fechaInicio = $request->fechaInicio;
    $fechaFin = $request->fechaFin;
    $tipoAccion = $request->tipoAccion;
    $bitacoras = Bitacora::orderBy('id', 'desc')
      ->accion($tipoAccion)
      ->fecha($fechaInicio, $fechaFin)
      ->get();

    sleep(1);
    return view('AcuerdosCU.Reporte.bitacora', compact('bitacoras'));
  }
}

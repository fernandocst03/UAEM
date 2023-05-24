<?php

namespace App\Http\Controllers\AcuerdosCU;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AcuerdosCU\AcuerdoTipo;
use App\Models\AcuerdosCU\Acuerdo;

class ReporteAcuerdoController extends Controller
{
  public function __invoke(Request $request)
  {
    $tipoAcuerdos = AcuerdoTipo::orderBy('id')->get();
    $fechaInicio = $request->fechaInicio;
    $fechaFin = $request->fechaFin;
    $tipoAcuerdo = $request->tipoAcuerdo;

    $acuerdos = Acuerdo::join('sesiones', 'acuerdos.sesion_id', '=', 'sesiones.id')
      ->orderBy('sesiones.fecha', 'desc')
      ->tipo($tipoAcuerdo)
      ->fecha($fechaInicio, $fechaFin)
      ->get();

    return view('AcuerdosCU.Reporte.acuerdo', compact('acuerdos', 'tipoAcuerdos', 'request'));
  }
}

<?php

namespace App\Http\Controllers\Formato911;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Formato911\UnidadAcademica;
use App\Models\Formato911\PersonalAdministrativo;
use App\Models\Formato911\Infraestructura;
use App\Models\Formato911\PersonalDocente;
use App\Models\Formato911\PersonalDocenteEdad;
use App\Models\Formato911\PersonalDocenteAntiguedad;

class UnidadAcademicaController extends Controller
{
  public function __invoke(Request $request)
  {
    $id = $request->unidadAcademica;
    $anio = $request->anio ? $request->anio : 2023;

    if ($request->unidadAcademica) {
      $unidadAcademica = UnidadAcademica::find($id);

      $personalAdministrativo = PersonalAdministrativo::orderBy('anio', 'desc')
        ->unidad($id)
        ->anio($anio)
        ->first();

      $personalDocente = PersonalDocente::orderBy('anio', 'desc')
        ->unidad($id)
        ->anio($anio)
        ->first();

      $personalDocenteAntiguedad = PersonalDocenteAntiguedad::orderBy('grupo_id')
        ->unidad($id)
        ->anio($anio)
        ->get();

      $personalDocenteEdad = PersonalDocenteEdad::orderBy('grupo_id')
        ->unidad($id)
        ->anio($anio)
        ->get();

      $infraestructura = Infraestructura::orderBy('anio', 'desc')
        ->unidad($id)
        ->anio($anio)
        ->first();

      sleep(1);
      return view('Formato911.Unidad-Academica.index', compact('unidadAcademica', 'personalAdministrativo', 'personalDocente', 'infraestructura', 'personalDocenteEdad', 'personalDocenteAntiguedad'));
    } else {
      $unidadAcademica = [];
      $personalAdministrativo = [];
      $infraestructura = [];
      $personalDocente = [];

      return view('Formato911.Unidad-Academica.index', [
        'unidadAcademica' => $unidadAcademica,
        'personalAdministrativo' => $personalAdministrativo,
        'personalDocente' => $personalDocente,
        'infraestructura' => $infraestructura
      ]);
    }
  }
}

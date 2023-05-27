<?php

namespace App\Http\Controllers\Formato911;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\formato911\UnidadAcademica;
use App\Models\formato911\PersonalAdministrativo;
use App\Models\formato911\Infraestructura;
use App\Models\formato911\PersonalDocente;
use App\Models\formato911\PersonalDocenteEdad;
use App\Models\formato911\PersonalDocenteAntiguedad;

class UnidadAcademicaController extends Controller
{
  public function __invoke(Request $request){
    $id = $request->unidadAcademicaId;
    $anio = $request->anio ? $request->anio : 2023;

    if($request->unidadAcademicaId){
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

      $personalDocentEdad = PersonalDocenteEdad::orderBy('grupo_id')
      ->unidad($id)
      ->anio($anio)
      ->get();

      $infraestructura = Infraestructura::orderBy('anio', 'desc')
        ->unidad($id)
        ->anio($anio)
        ->first();

     /*  $datos = [];
      foreach($personalAdministrativo as $item){
        $datos[] = ['name' => 'Directivos', 'y'=>$item->directivo_t];
        $datos[] = ['name' => 'Docentes', 'y'=>$item->docente_t];
        $datos[] = ['name' => 'Docentes investigadores', 'y'=>$item->docente_investigador_t];
        $datos[] = ['name' => 'Investigador', 'y'=>$item->investigador_t];
      } */

      return view('formato_911.unidad_academica.index', compact('unidadAcademica' , 'personalAdministrativo', 'personalDocente', 'infraestructura', 'personalDocentEdad', 'personalDocenteAntiguedad'));
    } else {
      $unidadAcademica = [];
      $personalAdministrativo = [];
      $infraestructura = [];
      $personalDocente = [];

      return view('formato_911.unidad_academica.index', [
        'unidadAcademica' => $unidadAcademica,
        'personalAdministrativo' => $personalAdministrativo,
        'personalDocente' => $personalDocente,
        'infraestructura' => $infraestructura
      ]);
    }
  }
}

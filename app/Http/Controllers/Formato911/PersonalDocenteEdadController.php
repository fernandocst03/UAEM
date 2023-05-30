<?php

namespace App\Http\Controllers\Formato911;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Formato911\EdadGrupo;
use App\Models\Formato911\PersonalDocenteEdad;
use App\Models\Formato911\UnidadAcademica;
use Exception;
use Illuminate\Support\Facades\Validator;

class PersonalDocenteEdadController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $unidadesAcademicas = UnidadAcademica::select()->orderBy('id')->get();
    $grupoEdad = EdadGrupo::select()->orderBy('id')->get();
    $personalDocente = PersonalDocenteEdad::select()->orderBy('id')->get();

    return view('Formato911.Personal-Docente-Edad.index', compact('unidadesAcademicas', 'grupoEdad', 'personalDocente'));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    //
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'anio' => ['required'],
      'unidad_academica' => ['required'],
      'grupo_edad' => ['required'],
      'hombres' => ['required'],
      'mujeres' => ['required'],
    ]);

    try {
      sleep(1);
      $personal = PersonalDocenteEdad::create([
        'unidad_academica_id' => $request->unidad_academica,
        'anio' => $request->anio,
        'grupo_id' => $request->grupo_edad,
        'hombres' => $request->hombres,
        'mujeres' => $request->mujeres,
        'total' => $request->hombres + $request->mujeres,
        'created_at' => now()
      ]);

      return redirect()->route('personal-docente-edad.index')
        ->with('success', 'Personal Docente por Edad creado correctamente');
    } catch (Exception $e) {
      return redirect()->route('personal-docente-edad.index')
        ->with('warning', 'No se pudo crear el Personal Docente por Edad: ' . $e->getMessage())->withErrors($validator);
    }
  }

  /**
   * Display the specified resource.
   */
  public function show(string $id)
  {
    $personalDocente = PersonalDocenteEdad::find($id);
    return view('Formato911.Personal-Docente-Edad.show', compact('personalDocente'));
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(string $id)
  {
    $grupoEdad = EdadGrupo::select()->orderBy('id')->get();
    $personalDocente = PersonalDocenteEdad::find($id);

    return view('Formato911.Personal-Docente-Edad.edit', compact('grupoEdad', 'personalDocente'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, string $id)
  {

    try {
      $request->validate([
        'anio' => ['required', 'regex:/^[0-9]{4}/'],
        'grupo_edad' => ['required'],
        'hombres' => ['required'],
        'mujeres' => ['required'],
      ]);
      sleep(1);
      $personal = PersonalDocenteEdad::find($id);
      $personal->anio = $request->anio;
      $personal->grupo_id = $request->grupo_edad;
      $personal->hombres = $request->hombres;
      $personal->mujeres = $request->mujeres;
      $personal->total = $request->hombres + $request->mujeres;
      $personal->updated_at = now();
      $personal->save();

      return redirect()->route('personal-docente-edad.edit', ['personal_docente_edad' => $id])->with('success', 'Actualizado correctamente.');
    } catch (Exception $e) {
      return redirect()->route('personal-docente-edad.edit', ['personal_docente_edad' => $id])
        ->with('warning', 'Ocurrio un error al intentar actualizar el personal docente por grupo de edad. ' . $e->getMessage());
    }
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Request $request, string $id)
  {
    $request->validateWithBag('userDeletion', [
      'password' => ['required', 'current-password'],
    ]);

    $personal = PersonalDocenteEdad::find($id);
    $personal->delete();

    return redirect()->route('personal-docente-antiguedad.index');
  }
}

<?php

namespace App\Http\Controllers\Formato911;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Formato911\EdadGrupo;
use App\Models\Formato911\PersonalDocenteEdad;
use App\Models\Formato911\UnidadAcademica;

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

    return view('formato_911.personal_docente_edad.index', [
      'personalDocente' => $personalDocente,
      'unidadesAcademicas' => $unidadesAcademicas,
      'grupoEdad' => $grupoEdad
    ]);
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
    $request->validate([
      'anio' => ['required'],
      'unidad_academica' => ['required'],
      'grupo_edad' => ['required'],
      'hombres' => ['required'],
      'mujeres' => ['required'],
    ]);

    $personal = PersonalDocenteEdad::create([
      'unidad_academica_id' => $request->unidad_academica,
      'anio' => $request->anio,
      'grupo_id' => $request->grupo_edad,
      'hombres' => $request->hombres,
      'mujeres' => $request->mujeres,
      'total' => $request->hombres + $request->mujeres,
      'created_at' => now()
    ]);

    return redirect()->route('personal-docente-edad.index');
  }

  /**
   * Display the specified resource.
   */
  public function show(string $id)
  {
    $personal = PersonalDocenteEdad::find($id);
    return view('formato_911.personal_docente_edad.show', [
      'personal' => $personal
    ]);
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(string $id)
  {
    $grupoEdad = EdadGrupo::select()->orderBy('id')->get();
    $personal = PersonalDocenteEdad::find($id);

    return view('formato_911.personal_docente_edad.edit', [
      'personal' => $personal,
      'grupoEdad' => $grupoEdad
    ]);
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, string $id)
  {
    $request->validate([
      'anio' => ['required', 'regex:/^[0-9]{4}/'],
      'grupo_antiguedad' => ['required'],
      'hombres' => ['required'],
      'mujeres' => ['required'],
    ]);

    $personal = PersonalDocenteEdad::find($id);
    $personal->anio = $request->anio;
    $personal->grupo_id = $request->grupo_antiguedad;
    $personal->hombres = $request->hombres;
    $personal->mujeres = $request->mujeres;
    $personal->total = $request->hombres + $request->mujeres;
    $personal->updated_at = now();
    $personal->save();

    return redirect()->route('personal-docente-edad.edit', ['personal_docente_edad' => $id])->with('status', 'success');
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

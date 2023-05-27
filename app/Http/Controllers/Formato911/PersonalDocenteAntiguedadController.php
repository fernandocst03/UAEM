<?php

namespace App\Http\Controllers\Formato911;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Formato911\AntiguedadGrupo;
use App\Models\Formato911\PersonalDocenteAntiguedad;
use App\Models\Formato911\UnidadAcademica;

class PersonalDocenteAntiguedadController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $unidadesAcademicas = UnidadAcademica::select()->orderBy('id')->get();
    $grupoAntiguedad = AntiguedadGrupo::select()->orderBy('id')->get();
    $personalDocente = PersonalDocenteAntiguedad::select()->orderBy('id')->get();

    return view('formato_911.personal_docente_antiguedad.index', [
      'personalDocente' => $personalDocente,
      'unidadesAcademicas' => $unidadesAcademicas,
      'grupoAntiguedad' => $grupoAntiguedad
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
      'grupo_antiguedad' => ['required'],
      'hombres' => ['required'],
      'mujeres' => ['required'],
    ]);

    $personal = PersonalDocenteAntiguedad::create([
      'unidad_academica_id' => $request->unidad_academica,
      'anio' => $request->anio,
      'grupo_id' => $request->grupo_antiguedad,
      'hombres' => $request->hombres,
      'mujeres' => $request->mujeres,
      'total' => $request->hombres + $request->mujeres,
      'created_at' => now()
    ]);

    return redirect()->route('personal-docente-antiguedad.index');
  }

  /**
   * Display the specified resource.
   */
  public function show(string $id)
  {
    $personal = PersonalDocenteAntiguedad::find($id);
    return view('formato_911.personal_docente_antiguedad.show', [
      'personal' => $personal
    ]);
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(string $id)
  {
    $grupoAntiguedad = AntiguedadGrupo::select()->orderBy('id')->get();
    $personal = PersonalDocenteAntiguedad::find($id);

    return view('formato_911.personal_docente_antiguedad.edit', [
      'personal' => $personal,
      'grupoAntiguedad' => $grupoAntiguedad
    ]);
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, string $id)
  {
    $request->validate([
      'anio' => ['required'],
      'grupo_antiguedad' => ['required'],
      'hombres' => ['required'],
      'mujeres' => ['required'],
    ]);

    $personal = PersonalDocenteAntiguedad::find($id);
    $personal->anio = $request->anio;
    $personal->grupo_id = $request->grupo_antiguedad;
    $personal->hombres = $request->hombres;
    $personal->mujeres = $request->mujeres;
    $personal->total = $request->hombres + $request->mujeres;
    $personal->updated_at = now();
    $personal->save();

    return redirect()->route('personal-docente-antiguedad.edit', ['personal_docente_antiguedad' => $id]);
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Request $request, string $id)
  {
    $request->validateWithBag('userDeletion', [
      'password' => ['required', 'current-password'],
    ]);

    $personal = PersonalDocenteAntiguedad::find($id);
    $personal->delete();

    return redirect()->route('personal-docente-antiguedad.index');
  }
}

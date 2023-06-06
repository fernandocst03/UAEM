<?php

namespace App\Http\Controllers\Formato911;

use App\Http\Controllers\Controller;
use App\Imports\PersonalDocenteAntiguedadImport;
use Illuminate\Http\Request;
use App\Models\Formato911\AntiguedadGrupo;
use App\Models\Formato911\PersonalDocenteAntiguedad;
use App\Models\Formato911\UnidadAcademica;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Exception;

class PersonalDocenteAntiguedadController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $unidadesAcademicas = UnidadAcademica::where('tipo_id', "!=", "10")
      ->where('tipo_id', "!=", "13")
      ->orderBy('id')
      ->get();
    $grupoAntiguedad = AntiguedadGrupo::select()->orderBy('id')->get();
    $personalDocente = PersonalDocenteAntiguedad::select()->orderBy('id')->get();

    return view('Formato911.Personal-Docente-Antiguedad.index', compact('unidadesAcademicas', 'grupoAntiguedad', 'personalDocente'));
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
    try {
      $validator = Validator::make($request->all(), [
        'anio' => ['required', 'integer'],
        'unidad_academica' => ['required', 'integer'],
        'grupo_antiguedad' => ['required', 'integer'],
        'hombres' => ['required', 'integer'],
        'mujeres' => ['required', 'integer'],
      ]);

      sleep(1);
      $personal = PersonalDocenteAntiguedad::create([
        'unidad_academica_id' => $request->unidad_academica,
        'anio' => $request->anio,
        'grupo_id' => $request->grupo_antiguedad,
        'hombres' => $request->hombres,
        'mujeres' => $request->mujeres,
        'total' => $request->hombres + $request->mujeres,
        'created_at' => now()
      ]);

      return redirect()->route('personal-docente-antiguedad.index')
        ->with('success', 'Personal docente por grupo de antiguedad creado correctamente.');
    } catch (Exception $e) {
      return redirect()->route('personal-docente-antiguedad.index')
        ->with('warning', 'Ocurrio un error al intentar crear el personal docente por grupo de antiguedad.')
        ->withErrors($validator);
    }
  }

  /**
   * Display the specified resource.
   */
  public function show(string $id)
  {
    $personalDocente = PersonalDocenteAntiguedad::find($id);
    return view('Formato911.Personal-Docente-Antiguedad.show', compact('personalDocente'));
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(string $id)
  {
    $grupoAntiguedad = AntiguedadGrupo::select()->orderBy('id')->get();
    $personalDocente = PersonalDocenteAntiguedad::find($id);

    return view('Formato911.Personal-Docente-Antiguedad.edit', compact('grupoAntiguedad', 'personalDocente'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, string $id)
  {

    try {
      $validator = Validator::make($request->all(), [
        'anio' => ['required', 'integer'],
        'grupo_antiguedad' => ['required', 'integer'],
        'hombres' => ['required', 'integer'],
        'mujeres' => ['required', 'integer'],
      ]);
      sleep(1);
      $personal = PersonalDocenteAntiguedad::find($id);
      $personal->anio = $request->anio;
      $personal->grupo_id = $request->grupo_antiguedad;
      $personal->hombres = $request->hombres;
      $personal->mujeres = $request->mujeres;
      $personal->total = $request->hombres + $request->mujeres;
      $personal->updated_at = now();
      $personal->save();

      return redirect()->route('personal-docente-antiguedad.edit', ['personal_docente_antiguedad' => $id])
        ->with('success', 'Actualizado correctamente.');
    } catch (Exception $e) {
      return redirect()->route('personal-docente-antiguedad.edit', ['personal_docente_antiguedad' => $id])
        ->with('warning', 'Ocurrio un error al intentar actualizar el personal docente por grupo de antiguedad.')
        ->withErrors($validator);
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

    $personal = PersonalDocenteAntiguedad::find($id);
    $personal->delete();

    return redirect()->route('personal-docente-antiguedad.index')->with('warning', 'Personal Administrativo eliminado correctamente');
  }

  public function file(Request $request, int $id)
  {
    $request->validateWithBag('userDeletion', [
      'password' => ['required', 'current-password'],
    ]);

    $personalDocenteAntiguedad = PersonalDocenteAntiguedad::find($id);
    $personalDocenteAntiguedad->status = false;
    $personalDocenteAntiguedad->save();

    return redirect()->route('personal-docente-antiguedad.index');
  }

  public function unarchive(Request $request, int $id)
  {
    $request->validateWithBag('userDeletion', [
      'password' => ['required', 'current-password'],
    ]);

    $personalDocenteAntiguedad = PersonalDocenteAntiguedad::find($id);
    $personalDocenteAntiguedad->status = true;
    $personalDocenteAntiguedad->save();

    return redirect()->route('personal-docente-antiguedad.index');
  }

  public function import(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'file' => 'required|mimes:xlsx, xls'
    ]);

    sleep(1);

    try {
      $file = $request->file('file');
      $import = new PersonalDocenteAntiguedadImport;
      Excel::import($import, $file);

      return redirect()->route('personal-docente-antiguedad.index')->with('success', 'Se la importación correctamente.');
    } catch (Exception  $e) {
      return back()->with('warning', 'Error al importar: ' . $e->getMessage());
    }
  }
}

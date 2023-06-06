<?php

namespace App\Http\Controllers\Formato911;

use App\Http\Controllers\Controller;
use App\Imports\PersonalDocenteEdadImport;
use Illuminate\Http\Request;
use App\Models\Formato911\EdadGrupo;
use App\Models\Formato911\PersonalDocenteEdad;
use App\Models\Formato911\UnidadAcademica;
use Exception;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class PersonalDocenteEdadController extends Controller
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
      'unidad_academica' => ['required', 'integer'],
      'anio' => ['required', 'regex:/^[0-9]{4}/', 'integer'],
      'grupo_edad' => ['required', 'integer'],
      'hombres' => ['required', 'integer'],
      'mujeres' => ['required', 'integer'],
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
        ->with('warning', 'No se pudo crear el Personal Docente por Edad.')
        ->withErrors($validator);
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
      $validator = Validator::make($request->all(), [
        'anio' => ['required', 'regex:/^[0-9]{4}/', 'integer'],
        'grupo_edad' => ['required', 'integer'],
        'hombres' => ['required', 'integer'],
        'mujeres' => ['required', 'integer'],
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
        ->with('warning', 'Ocurrio un error al intentar actualizar el personal docente por grupo de edad.')
        ->WithErrors($validator);
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

    return redirect()->route('personal-docente-edad.index')->with('warning', 'Personal Docente por Edad eliminado correctamente');
  }

  public function import(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'file' => 'required|mimes:xlsx, xls'
    ]);

    sleep(1);

    try {
      $file = $request->file('file');

      $import = new PersonalDocenteEdadImport;
      Excel::import($import, $file);

      return redirect()->route('personal-docente-edad.index')->with('success', 'Se realizo la importación correctamente.');
    } catch (Exception  $e) {
      return back()->with('warning', 'Error al importar: ' . $e->getMessage());
    }
  }

  public function file(Request $request, int $id)
  {
    $request->validateWithBag('userDeletion', [
      'password' => ['required', 'current-password'],
    ]);

    $personalDocente = PersonalDocenteEdad::find($id);
    $personalDocente->status = false;
    $personalDocente->save();

    return redirect()->route('personal-docente-edad.index');
  }

  public function unarchive(Request $request, int $id)
  {
    $request->validateWithBag('userDeletion', [
      'password' => ['required', 'current-password'],
    ]);

    $personalDocente = PersonalDocenteEdad::find($id);
    $personalDocente->status = true;
    $personalDocente->save();

    return redirect()->route('personal-docente-edad.index');
  }
}

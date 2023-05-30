<?php

namespace App\Http\Controllers\Formato911;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Formato911\PersonalAdministrativo;
use App\Models\Formato911\UnidadAcademica;
use Exception;
use Illuminate\Support\Facades\Validator;

class PersonalAdministrativoController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $unidadesAcademicas = UnidadAcademica::select()->orderBy('id')->get();
    $personalAdministrativo = PersonalAdministrativo::select()->orderBy('id', 'DESC')->get();
    sleep(1);

    return view('Formato911.Personal-Administrativo.index', compact('personalAdministrativo', 'unidadesAcademicas'));
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
      $validator  = Validator::make($request->all(), [
        'unidad_academica' => ['required', 'integer'],
        'anio' => ['required', 'integer', 'regex:/^[0-9]{4}$/'],
        'directivo_h' => ['required', 'integer', 'min:0'],
        'directivo_m' => ['required', 'integer', 'min:0'],
        'docente_h' => ['required', 'integer', 'min:0'],
        'docente_m' => ['required', 'integer', 'min:0'],
        'docente_investigador_h' => ['required', 'integer', 'min:0'],
        'docente_investigador_m' => ['required', 'integer', 'min:0'],
        'investigador_h' => ['required', 'integer', 'min:0'],
        'investigador_m' => ['required', 'integer', 'min:0'],
        'auxiliar_investigador_h' => ['required', 'integer', 'min:0'],
        'auxiliar_investigador_m' => ['required', 'integer', 'min:0'],
        'administrativos_h' => ['required', 'integer', 'min:0'],
        'administrativos_m' => ['required', 'integer', 'min:0'],
        'otros_h' => ['required', 'integer', 'min:0'],
        'otros_m' => ['required', 'integer', 'min:0']
      ]);
      sleep(1);

      $personalAdministrativo = PersonalAdministrativo::create([
        'unidad_academica_id' => $request->unidad_academica,
        'anio' => $request->anio,
        'directivo_h' => $request->directivo_h,
        'directivo_m' => $request->directivo_m,
        'directivo_t' => $request->directivo_h + $request->directivo_m,
        'docente_h' => $request->docente_h,
        'docente_m' => $request->docente_m,
        'docente_t' => $request->docente_h + $request->docente_m,
        'docente_investigador_h' => $request->docente_investigador_h,
        'docente_investigador_m' => $request->docente_investigador_m,
        'docente_investigador_t' => $request->docente_investigador_h + $request->docente_investigador_m,
        'investigador_h' => $request->investigador_h,
        'investigador_m' => $request->investigador_m,
        'investigador_t' => $request->investigador_h + $request->investigador_m,
        'auxiliar_investigador_h' => $request->auxiliar_investigador_h,
        'auxiliar_investigador_m' => $request->auxiliar_investigador_m,
        'auxiliar_investigador_t' => $request->auxiliar_investigador_h + $request->auxiliar_investigador_m,
        'administrativo_h' => $request->administrativos_h,
        'administrativo_m' => $request->administrativos_m,
        'administrativo_t' => $request->administrativos_h + $request->administrativos_m,
        'otros_h' => $request->otros_h,
        'otros_m' => $request->otros_m,
        'otros_t' => $request->otros_h + $request->otros_m,
      ]);
      return redirect()->route('personal-administrativo.index')
        ->with('success', 'Personal Administrativo agregado correctamente');
    } catch (Exception $e) {
      return redirect()->route('personal-administrativo.index')
        ->with('warning', 'Ocurrio un error al agregar el Personal Administrativo ')
        ->withErrors($validator);
    }
  }

  /**
   * Display the specified resource.
   */
  public function show(string $id)
  {
    $personalAdministrativo = PersonalAdministrativo::find($id);
    return view('Formato911.Personal-Administrativo.show', compact('personalAdministrativo'));
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(string $id)
  {
    $personalAdministrativo = PersonalAdministrativo::find($id);
    return view('Formato911.Personal-Administrativo.edit', compact('personalAdministrativo'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, string $id)
  {
    try {
      $validator = Validator::make($request->all(), [
        'anio' => ['required', 'integer', 'regex:/^[0-9]{4}$/'],
        'directivo_h' => ['required', 'integer', 'min:0'],
        'directivo_m' => ['required', 'integer', 'min:0'],
        'docente_h' => ['required', 'integer', 'min:0'],
        'docente_m' => ['required', 'integer', 'min:0'],
        'docente_investigador_h' => ['required', 'integer', 'min:0'],
        'docente_investigador_m' => ['required', 'integer', 'min:0'],
        'investigador_h' => ['required', 'integer', 'min:0'],
        'investigador_m' => ['required', 'integer', 'min:0'],
        'auxiliar_investigador_h' => ['required', 'integer', 'min:0'],
        'auxiliar_investigador_m' => ['required', 'integer', 'min:0'],
        'administrativos_h' => ['required', 'integer', 'min:0'],
        'administrativos_m' => ['required', 'integer', 'min:0'],
        'otros_h' => ['required', 'integer', 'min:0'],
        'otros_m' => ['required', 'integer', 'min:0']
      ]);
      sleep(1);

      $perAdmin = PersonalAdministrativo::find($id);
      $perAdmin->anio = $request->anio;
      $perAdmin->directivo_h = $request->directivo_h;
      $perAdmin->directivo_m = $request->directivo_m;
      $perAdmin->directivo_t = $request->directivo_h + $request->directivo_m;
      $perAdmin->docente_h = $request->docente_h;
      $perAdmin->docente_m = $request->docente_h;
      $perAdmin->docente_t = $request->docente_h + $request->docente_m;
      $perAdmin->docente_investigador_h = $request->docente_investigador_h;
      $perAdmin->docente_investigador_m = $request->docente_investigador_m;
      $perAdmin->docente_investigador_t = $request->docente_investador_h + $request->docente_investigador_m;
      $perAdmin->investigador_h = $request->investigador_h;
      $perAdmin->investigador_m = $request->investigador_m;
      $perAdmin->investigador_t = $request->investigador_h + $request->investigador_m;
      $perAdmin->auxiliar_investigador_h = $request->auxiliar_investigador_h;
      $perAdmin->auxiliar_investigador_m = $request->auxiliar_investigador_m;
      $perAdmin->auxiliar_investigador_t = $request->auxiliar_investigador_h + $request->auxiliar_investigador_m;
      $perAdmin->administrativo_h = $request->administrativo_h;
      $perAdmin->administrativo_m = $request->administrativo_m;
      $perAdmin->administrativo_t = $request->administrativo_h + $request->administrativo_m;
      $perAdmin->otros_h = $request->otros_h;
      $perAdmin->otros_m = $request->otros_m;
      $perAdmin->otros_t = $request->otros_h + $request->otros_m;
      $perAdmin->save();

      return redirect()->route('personal-administrativo.edit', ['personal_administrativo' => $id])
        ->with('success', 'Actualizado correctamente');
    } catch (Exception $e) {
      return redirect()->route('personal-administrativo.edit', ['personal_administrativo' => $id])
        ->with('warning', 'Ocurrio un error al actualizar el Personal Administrativo.')
        ->withErrors($validator);
    }
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id, Request $request)
  {
    $request->validateWithBag('userDeletion', [
      'password' => ['required', 'current-password'],
    ]);

    $perAdmin = PersonalAdministrativo::find($id);
    $perAdmin->delete();

    return redirect()->route('personal-administrativo.index')->with('warning', 'Personal Administrativo eliminado correctamente');
  }

  public function file(Request $request, int $id)
  {
    $request->validateWithBag('userDeletion', [
      'password' => ['required', 'current-password'],
    ]);

    $personalAdministrativo = PersonalAdministrativo::find($id);
    $personalAdministrativo->status = false;
    $personalAdministrativo->save();

    return redirect()->route('personal-administrativo.index');
  }

  public function unarchive(Request $request, int $id)
  {
    $request->validateWithBag('userDeletion', [
      'password' => ['required', 'current-password'],
    ]);

    $personalAdministrativo = PersonalAdministrativo::find($id);
    $personalAdministrativo->status = true;
    $personalAdministrativo->save();

    return redirect()->route('personal-administrativo.index');
  }
}

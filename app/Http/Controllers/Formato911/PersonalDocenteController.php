<?php

namespace App\Http\Controllers\Formato911;

use App\Http\Controllers\Controller;
use App\Imports\PersonalDocenteImport;
use Illuminate\Http\Request;
use App\Models\Formato911\UnidadAcademica;
use App\Models\Formato911\PersonalDocente;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Exception;

class PersonalDocenteController extends Controller
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
    $personalDocente = PersonalDocente::select()->orderBy('id')->get();

    return view('Formato911.Personal-Docente.index', compact('unidadesAcademicas', 'personalDocente'));
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    try {
      $validator = Validator::make($request->all(), [
        'unidad_academica' => ['required'],
        'anio' => ['required', 'integer', 'min:0'],
        'pitc_h' => ['required', 'integer', 'min:0'],
        'pitc_m' => ['required', 'integer', 'min:0'],
        'p34t_h' => ['required', 'integer', 'min:0'],
        'p34t_m' => ['required', 'integer', 'min:0'],
        'pmt_h' => ['required', 'integer', 'min:0'],
        'pmt_m' => ['required', 'integer', 'min:0'],
        'pph_h' => ['required', 'integer', 'min:0'],
        'pph_m' => ['required', 'integer', 'min:0'],
      ]);

      sleep(1);
      $personalDocente = PersonalDocente::create([
        'unidad_academica_id' => $request->unidad_academica,
        'anio' => $request->anio,
        'pitc_h' => $request->pitc_h,
        'pitc_m' => $request->pitc_m,
        'pitc_t' => $request->pitc_h + $request->pitc_m,
        'p34t_h' => $request->p34t_h,
        'p34t_m' => $request->p34t_m,
        'p34t_t' => $request->p34t_h + $request->p34t_m,
        'pmt_h' => $request->pmt_h,
        'pmt_m' => $request->pmt_m,
        'pmt_t' => $request->pmt_h + $request->pmt_m,
        'pph_h' => $request->pph_h,
        'pph_m' => $request->pph_m,
        'pph_t' => $request->pph_h + $request->pph_m,
        'created_at' => now()
      ]);
      return redirect()->route('personal-docente.index')
        ->with('success', 'Personal Docente creado correctamente');
    } catch (Exception $e) {
      return redirect()->back()
        ->with('warning', 'Ocurrio un error al crear el Personal Docente ')
        ->withErrors($validator);
    }
  }

  /**
   * Display the specified resource.
   */
  public function show(string $id)
  {
    $personalDocente = PersonalDocente::find($id);
    return view('Formato911.Personal-Docente.show', compact('personalDocente'));
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(string $id)
  {
    $personalDocente = PersonalDocente::find($id);
    return view('Formato911.Personal-Docente.edit', compact('personalDocente'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, string $id)
  {
    try {
      $validator = Validator::make($request->all(), [
        'anio' => ['required', 'integer', 'min:0'],
        'pitc_h' => ['required', 'integer', 'min:0'],
        'pitc_m' => ['required', 'integer', 'min:0'],
        'p34t_h' => ['required', 'integer', 'min:0'],
        'p34t_m' => ['required', 'integer', 'min:0'],
        'pmt_h' => ['required', 'integer', 'min:0'],
        'pmt_m' => ['required', 'integer', 'min:0'],
        'pph_h' => ['required', 'integer', 'min:0'],
        'pph_m' => ['required', 'integer', 'min:0'],
      ]);

      $personal = PersonalDocente::find($id);
      $personal->anio = $request->anio;
      $personal->pitc_h = $request->pitc_h;
      $personal->pitc_m = $request->pitc_m;
      $personal->pitc_t = $request->pitc_h + $request->pitc_m;
      $personal->p34t_h = $request->p34t_h;
      $personal->p34t_m = $request->p34t_m;
      $personal->p34t_t = $request->p34t_h + $request->p34t_m;
      $personal->pmt_h = $request->pmt_h;
      $personal->pmt_m = $request->pmt_m;
      $personal->pmt_t = $request->pmt_h + $request->pmt_m;
      $personal->pph_h = $request->pph_h;
      $personal->pph_m = $request->pph_m;
      $personal->pph_t = $request->pph_h + $request->pph_m;
      $personal->save();

      sleep(1);
      return redirect()->route('personal-docente.edit', ['personal_docente' => $id])
        ->with('success', 'Personal Docente se actualizado correctamente');
    } catch (Exception $e) {
      return redirect()->back()
        ->with('warning', 'Ocurrio un error al actualizar el Personal Docente.')
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
    $personalDocente = PersonalDocente::find($id);
    $personalDocente->delete();

    return view('Formato911.Personal-Docente.index')
      ->with('warning', 'Personal Docente eliminado correctamente');
  }

  public function file(Request $request, int $id)
  {
    $request->validateWithBag('userDeletion', [
      'password' => ['required', 'current-password'],
    ]);

    $personalDocente = PersonalDocente::find($id);
    $personalDocente->status = false;
    $personalDocente->save();

    return redirect()->route('personal-docente.index');
  }

  public function unarchive(Request $request, int $id)
  {
    $request->validateWithBag('userDeletion', [
      'password' => ['required', 'current-password'],
    ]);

    $personalDocente = PersonalDocente::find($id);
    $personalDocente->status = true;
    $personalDocente->save();

    return redirect()->route('personal-docente.index');
  }

  public function import(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'file' => 'required|mimes:xlsx, xls'
    ]);

    sleep(1);

    try {
      if ($validator->fails()) {
        $file = $request->file('file');

        $import = new PersonalDocenteImport;
        Excel::import($import, $file);

        // dd('Row count: ' . $import->getRowCount());
        $numero = $import->getRowCount();
        return redirect()->route('personal-administrativo.index')->with('success', 'Se importaron ' . $numero . ' registros.');
      } else return redirect()->back()->withErrors($validator);
    } catch (Exception  $e) {
      return back()->with('warning', 'Error al importar: ' . $e->getMessage());
    }
  }
}

<?php

namespace App\Http\Controllers\formato911;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Formato911\UnidadAcademica;
use App\Models\Formato911\Infraestructura;
use App\Models\Formato911\InfraestructuraInmuebleConstruccion;
use App\Models\Formato911\InfraestructuraInmueblePropiedad;
use App\Imports\InfraestructuraImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;
use Exception;

class InfraestructuraController extends Controller
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
    $infraestructuras = Infraestructura::orderBy('id', 'desc')->get();
    return view('Formato911.Infraestructura.index', compact('infraestructuras', 'unidadesAcademicas'));
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
        'unidad_academica' => ['required'],
        'anio' => ['required', 'integer'],
        'tipoInmueble' => ['required'],
        'tipoAula' => ['required'],
        'aulas_existentes' => ['required', 'integer'],
        'aulas_en_uso' => ['required', 'integer'],
        'aulas_adaptadas' => ['required', 'integer'],
        'talleres_existentes' => ['required', 'integer'],
        'talleres_en_uso' => ['required', 'integer'],
        'talleres_adaptados' => ['required', 'integer'],
        'laboratorios_existentes' => ['required', 'integer'],
        'laboratorios_en_uso' => ['required', 'integer'],
        'laboratorios_adaptados' => ['required', 'integer'],
        'laboratorio_computo' => ['required', 'integer'],
        'biblioteca' => ['required']
      ]);

      sleep(1);
      $infraestructura = Infraestructura::create([
        'unidad_academica_id' => $request->unidad_academica,
        'anio' => $request->anio,
        'inmueble_tipo_id' => $request->tipoInmueble,
        'aula_tipo_id' => $request->tipoAula,
        'aulas_existentes' => $request->aulas_existentes,
        'aulas_en uso' => $request->aulas_en_uso,
        'aulas_adaptadas' => $request->aulas_adaptadas,
        'talleres_existentes' => $request->talleres_existentes,
        'talleres_en_uso' => $request->talleres_en_uso,
        'talleres_adapatdos' => $request->talleres_adaptados,
        'laboratorios_existentes' => $request->laboratorios_existentes,
        'laboratorios_en_uso' => $request->laboratorios_en_uso,
        'laboratorios_adaptados' => $request->laboratorios_adaptados,
        'laboratorios_computo' => $request->laboratorio_computo,
        'biblioteca' => $request->biblioteca
      ]);

      bitacora(
        $accion_id = 3,
        $seccion = 'Infraestructura',
        $registro_id = $infraestructura->id,
        $registro_nuevo = $infraestructura
      );

      return redirect()->route('infraestructuras.index')->with('success', 'Infraestructura creada correctamente');
    } catch (Exception  $e) {
      return redirect()->route('infraestructuras.index')->with('warning', 'Error al crear la infraestructura.' . $e->getMessage())
        ->withErrors($validator);
    }
  }

  /**
   * Display the specified resource.
   */
  public function show(string $id)
  {
    $infraestructura = Infraestructura::find($id);

    if (Auth::check()) {
      bitacora(
        $accion_id = 2,
        $seccion = 'Infraestructura',
        $registro_id = $infraestructura->id,
      );
    }

    return view('Formato911.Infraestructura.show', compact('infraestructura'));
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(string $id)
  {
    $inmuebleTipos = InfraestructuraInmuebleConstruccion::all();
    $aulaTipos = InfraestructuraInmueblePropiedad::all();
    $infraestructura = Infraestructura::find($id);
    return view('Formato911.Infraestructura.edit', compact('infraestructura', 'inmuebleTipos', 'aulaTipos'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, string $id)
  {
    try {
      $validator = Validator::make($request->all(), [
        'anio' => ['required', 'integer'],
        'tipoInmueble' => ['required'],
        'tipoAula' => ['required'],
        'aulas_existentes' => ['required', 'integer'],
        'aulas_en_uso' => ['required', 'integer'],
        'aulas_adaptadas' => ['required', 'integer'],
        'talleres_existentes' => ['required', 'integer'],
        'talleres_en_uso' => ['required', 'integer'],
        'talleres_adaptados' => ['required', 'integer'],
        'laboratorios_existentes' => ['required', 'integer'],
        'laboratorios_en_uso' => ['required', 'integer'],
        'laboratorios_adaptados' => ['required', 'integer'],
        'laboratorio_computo' => ['required', 'integer'],
        'biblioteca' => ['required']
      ]);
      sleep(1);
      $infraestructura = Infraestructura::find($id);
      $old_value = $infraestructura->getOriginal();
      $infraestructura->anio = $request->anio;
      $infraestructura->inmueble_tipo_id = $request->tipoInmueble;
      $infraestructura->aula_tipo_id = $request->tipoAula;
      $infraestructura->aulas_existentes = $request->aulas_existentes;
      $infraestructura->aulas_en_uso = $request->aulas_en_uso;
      $infraestructura->aulas_adaptadas = $request->aulas_adaptadas;
      $infraestructura->talleres_existentes = $request->talleres_existentes;
      $infraestructura->talleres_en_uso = $request->talleres_en_uso;
      $infraestructura->talleres_adaptados = $request->talleres_adaptados;
      $infraestructura->laboratorios_existentes = $request->laboratorios_existentes;
      $infraestructura->laboratorios_en_uso = $request->laboratorios_en_uso;
      $infraestructura->laboratorios_adaptados = $request->laboratorios_adaptados;
      $infraestructura->laboratorios_computo = $request->laboratorio_computo;
      $infraestructura->biblioteca = $request->biblioteca;
      $infraestructura->save();

      bitacora(
        $accion = 4,
        $seccion = 'Infraestructura',
        $registro_id = $id,
        $registro_anterior = json_encode($old_value),
        $registro_nuevo = json_encode($infraestructura)
      );

      return redirect()->route('infraestructuras.edit', ['infraestructura' => $id])->with('success', 'Editado correctamente');
    } catch (Exception  $e) {
      return redirect()->route('infraestructuras.edit', ['infraestructura' => $id])
        ->with('warning', 'Ocurrio un error al actualizar la infraestructura.')
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

    $infraestructura = Infraestructura::find($id);

    bitacora(
      $accion_id = 5,
      $seccion = 'Infraestructura',
      $registro_id = $id,
      $registro_anterior = $infraestructura,
    );

    $infraestructura->delete();

    return redirect()->route('infraestructuras.index')->with('warning', 'Eliminado correctamente');
  }

  public function file(Request $request, int $id)
  {
    $request->validateWithBag('userDeletion', [
      'password' => ['required', 'current-password'],
    ]);

    $infraestructura = Infraestructura::find($id);
    $infraestructura->status = false;
    $infraestructura->save();

    return redirect()->route('infraestructuras.index');
  }

  public function unarchive(Request $request, int $id)
  {
    $request->validateWithBag('userDeletion', [
      'password' => ['required', 'current-password'],
    ]);

    $infraestructura = Infraestructura::find($id);
    $infraestructura->status = true;
    $infraestructura->save();

    return redirect()->route('infraestructuras.index');
  }

  public function import(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'file' => 'required|mimes:xlsx, xls'
    ]);

    sleep(1);

    try {
      $file = $request->file('file');
      $import = new InfraestructuraImport;
      Excel::import($import, $file);
      return redirect()->route('infraestructuras.index')->with('success', 'Se realizo la importación correctamente');
    } catch (Exception  $e) {
      return back()->with('warning', 'Error al importar: ' . $e->getMessage());
    }
  }
}

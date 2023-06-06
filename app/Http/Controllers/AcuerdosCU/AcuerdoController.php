<?php

namespace App\Http\Controllers\AcuerdosCU;

use App\Http\Controllers\Controller;
use App\Imports\AcuerdoImport;
use App\Models\AcuerdosCU\Acuerdo;
use App\Models\AcuerdosCU\AcuerdoTipo;
use App\Models\AcuerdosCU\Sesion;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class AcuerdoController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $lastFiveSesions = Sesion::orderBy('id', 'desc')->take(5)->get();
    $lastSesion = Sesion::orderBy('id', 'desc')->first();
    return view('AcuerdosCU.Acuerdo.index', compact('lastSesion', 'lastFiveSesions'));
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
  public function store(Request $request, $id = null)
  {
    try {
      $validator  = Validator::make($request->all(), [
        'tipoAcuerdo' => ['required', 'integer'],
        'punto' => ['required', 'integer'],
        'acuerdo' => ['required', 'string'],
        'acuerdoCorto' => ['required', 'string'],
        'paginaSamara' => ['integer'],
      ]);
      sleep(1);

      $acuerdo = Acuerdo::create([
        'sesion_id' => $id | $request->sesionId,
        'acuerdo_tipo_id' => $request->tipoAcuerdo,
        'punto' => $request->punto,
        'acuerdo' => $request->acuerdo,
        'tipo_otro' => $request->tipoOtro,
        'acuerdo_corto' => $request->acuerdoCorto,
        'observaciones' => $request->observaciones,
        'pagina_samara' => $request->paginaSamara,
      ]);

      $sesion = $acuerdo->sesion_id;

      bitacora(
        $accionId = 3,
        $seccion = 'Acuerdos',
        $registroId = $acuerdo->id,
        $newValue = $acuerdo
      );

      return redirect()->route('sesiones.show', ['sesione' => $sesion])
        ->with('success', 'Acuerdo creado correctamente');
    } catch (Exception $e) {
      return redirect()->back()
        ->with('warning', 'Error al crear el acuerdo.')
        ->withErrors($validator);
    }
  }

  /**
   * Display the specified resource.
   */
  public function show(string $id)
  {
    $acuerdo = Acuerdo::find($id);

    if (Auth::check()) {
      bitacora(
        $accionId = 2,
        $seccion = 'Acuerdos',
        $registroId = $id
      );
    }

    return view('AcuerdosCU.Acuerdo.show', compact('acuerdo'));
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(string $id)
  {
    $acuerdo = Acuerdo::find($id);
    $tipoAcuerdos = AcuerdoTipo::orderBy('id')->get();
    return view('AcuerdosCU.Acuerdo.edit', compact('acuerdo', 'tipoAcuerdos'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, string $id)
  {
    try {
      $validator  = Validator::make($request->all(), [
        'tipoAcuerdo' => ['required', 'integer'],
        'punto' => ['required', 'integer'],
        'acuerdo' => ['required', 'string'],
        'acuerdoCorto' => ['required', 'string'],
        'paginaSamara' => ['integer']
      ]);
      sleep(1);

      $acuerdo = Acuerdo::find($id);
      $old_value = $acuerdo->getOriginal();

      $acuerdo->acuerdo_tipo_id = $request->tipoAcuerdo;
      $acuerdo->punto = $request->punto;
      $acuerdo->acuerdo = $request->acuerdo;
      $acuerdo->acuerdo_corto = $request->acuerdoCorto;
      $acuerdo->observaciones = $request->observaciones;
      $acuerdo->pagina_samara = $request->paginaSamara;
      $acuerdo->save();

      bitacora(
        $accionId = 3,
        $seccion = 'Acuerdos',
        $registroId = $acuerdo->id,
        $oldValue = json_encode($old_value),
        $newValue = json_encode($acuerdo)
      );
      return redirect()->route('acuerdos.edit', ['acuerdo' => $id])->with('success', 'Editado correctamente');
    } catch (Exception $e) {
      return redirect()->route('acuerdos.edit', ['acuerdo' => $id])
        ->with('warning', 'Error al editar el acuerdo.')
        ->withErrors($validator);
    }
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id, Request $request)
  {
    $request->validateWithBag('userDeletion', [
      'password' => ['required', 'current-password']
    ]);
    $acuerdo = Acuerdo::find($id);
    $sesionId = $acuerdo->sesion_id;
    bitacora(
      $accionId = 5,
      $seccion = 'Acuerdos',
      $registroId = $id,
      $oldValue = $acuerdo
    );
    $acuerdo->delete();

    return redirect()->route('sesiones.show', ['sesione' => $sesionId])->with('warning', 'El acuerdo se ha eliminado correctamente');
  }

  /**
   * Upload an excel file to import data
   */
  public function file(Request $request, int $id)
  {
    $request->validateWithBag('userDeletion', [
      'password' => ['required', 'current-password'],
    ]);

    $acuerdo = Acuerdo::find($id);
    $acuerdo->status = false;
    $acuerdo->save();

    return redirect()->route('acuerdos.index');
  }

  public function unarchive(Request $request, int $id)
  {
    $request->validateWithBag('userDeletion', [
      'password' => ['required', 'current-password'],
    ]);

    $acuerdo = Acuerdo::find($id);
    $acuerdo->status = true;
    $acuerdo->save();

    return redirect()->route('acuerdos.index');
  }

  public function import(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'file' => 'required|mimes:xlsx, xls'
    ]);

    sleep(1);

    try {
      $file = $request->file('file');
      $import = new AcuerdoImport;
      Excel::import($import, $file);

      return redirect()->route('acuerdos.index')->with('success', 'Se realizo la importación correctamente');
    } catch (Exception  $e) {
      return back()->with('warning', 'Error al importar: ' . $e->getMessage());
    }
  }
}

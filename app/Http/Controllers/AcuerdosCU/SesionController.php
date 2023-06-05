<?php

namespace App\Http\Controllers\AcuerdosCU;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Imports\SesionImport;
use Illuminate\Http\Request;
use App\Models\AcuerdosCU\Sesion;
use App\Models\AcuerdosCU\Samara;
use Exception;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class SesionController extends Controller
{

  public function index()
  {
    $sesiones = Sesion::orderBy('id', 'desc')->get();
    $samara = Samara::select()->orderBy('id', 'desc')->first();
    return view('AcuerdosCU.Sesion.index', compact('sesiones', 'samara'));
  }


  public function create()
  {
    //
  }


  public function store(Request $request)
  {
    try {
      $validator = Validator::make($request->all(), [
        'fecha' => ['required', 'date'],
        'tipoSesion' => ['required']
      ]);

      sleep(1);

      $sesion = Sesion::create([
        'fecha' => $request->fecha,
        'tipo_id' => $request->tipoSesion
      ]);
      $fecha = $sesion->fecha;

      bitacora(
        $accionId = 3,
        $seccion = 'Sesiones',
        $registroId = $sesion->id,
        $newValue = $sesion
      );
      return redirect()->route('sesiones.index')
        ->with('success', 'Sesion del dia ' . $fecha . ' creada correctamente.');
    } catch (Exception $e) {
      return redirect()->route('sesiones.index')
        ->with('warning', 'Error al crear la sesión')
        ->withErrors($validator);
    }
  }


  public function show(int $id)
  {
    $sesion = Sesion::find($id);
    if (Auth::check()) {
      bitacora(
        $accionId = 2,
        $seccion = 'Sesiones',
        $registroId = $id,
      );
    }
    return view('AcuerdosCU.Sesion.show', compact('sesion'));
  }


  public function edit(string $id)
  {
    $sesion = Sesion::find($id);
    return view('AcuerdosCU.Sesion.edit', compact('sesion'));
  }


  public function update(Request $request, string $id)
  {
    try {
      $validator = Validator::make($request->all(), [
        'fecha' => ['required', 'date'],
        'tipoSesion' => ['required']
      ]);
      sleep(1);
      $sesion = Sesion::find($id);
      $old_value = $sesion->getOriginal();

      $sesion->tipo_id = $request->tipoSesion;
      $sesion->fecha = $request->fecha;

      bitacora(
        $accionId = 4,
        $seccion = 'Sesiones',
        $resgistroId = $sesion->id,
        $oldValue = json_encode($old_value),
        $newValue = json_encode($sesion)
      );

      $sesion->save();
      return redirect()->route('sesiones.edit', ['sesione' => $sesion->id])->with('success', 'Sesion actializada correctamente.');
    } catch (Exception $e) {
      return redirect()->route('sesiones.edit', ['sesione' => $sesion->id])->with('warning', 'Error al editar la sesion')
        ->withErrors($validator);
    }
  }


  public function destroy(string $id, Request $request)
  {
    $request->validateWithBag('userDeletion', [
      'password' => ['required', 'current-password'],
    ]);

    $sesion = Sesion::find($id);
    $fechaSesion = $sesion->fecha;
    $sesion->delete();

    bitacora(
      $accionId = 5,
      $seccion = 'Sesiones',
      $registroId = $sesion->id,
      $oldValue = $sesion
    );
    return redirect()->route('sesiones.index')->with(['warning' => 'Sesión del dia ' . $fechaSesion . ' eliminada correctamente.']);
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

        $import = new SesionImport;
        Excel::import($import, $file);

        // dd('Row count: ' . $import->getRowCount());
        $numero = $import->getRowCount();
        return redirect()->route('personal-administrativo.index')->with('success', 'Se importaron ' . $numero . ' registros.');
      } else return redirect()->back()->withErrors($validator);
    } catch (Exception  $e) {
      return back()->with('warning', 'Error al importar: ' . $e->getMessage());
    }
  }

  public function file(Request $request, int $id)
  {
    $request->validateWithBag('userDeletion', [
      'password' => ['required', 'current-password'],
    ]);

    $sesion = Sesion::find($id);
    $sesion->status = false;
    $sesion->save();

    return redirect()->route('sesiones.index');
  }

  public function unarchive(Request $request, int $id)
  {
    $request->validateWithBag('userDeletion', [
      'password' => ['required', 'current-password'],
    ]);

    $sesion = Sesion::find($id);
    $sesion->status = true;
    $sesion->save();

    return redirect()->route('sesiones.index');
  }
}

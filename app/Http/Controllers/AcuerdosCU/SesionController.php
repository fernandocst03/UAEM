<?php

namespace App\Http\Controllers\AcuerdosCU;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AcuerdosCU\Sesion;
use App\Models\AcuerdosCU\Samara;
use Illuminate\Support\Facades\Validator;

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
    $validator = Validator::make($request->all(), [
      'fecha' => ['required', 'date'],
      'tipoSesion' => ['required']
    ]);

    sleep(1);

    if ($validator->fails()) {
      return redirect()->back()->withErrors($validator);
    } else {

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
      return redirect()->route('sesiones.index')->with('success', 'Sesion del dia ' . $fecha . ' creada correctamente.');
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
    $validator = Validator::make($request->all(), [
      'fecha' => ['required', 'date'],
      'tipoSesion' => ['required']
    ]);
    sleep(1);

    if ($validator->fails()) {
      return redirect()->back()->withErrors($validator);
    } else {
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
}

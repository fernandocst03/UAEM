<?php

namespace App\Http\Controllers\AcuerdosCU;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AcuerdosCU\Samara;
use App\Models\AcuerdosCU\SamaraSesion;
use App\Models\AcuerdosCU\Rectorado;
use App\Models\AcuerdosCU\Sesion;
use Exception;
use Illuminate\Support\Facades\Validator;

class SamaraController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $last_rectorado = Rectorado::select()->orderBy('id', 'desc')->first();
    $rectorados = Rectorado::select()->orderBy('id', 'desc')->get();
    $sesiones = Sesion::select()->orderBy('id', 'desc')->get();

    return view('AcuerdosCU.Samara.index', compact('last_rectorado', 'rectorados', 'sesiones'));
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
        'anio' => ['required', 'alpha'],
        'numero' => ['required', 'integer'],
        'fecha' => ['required', 'date'],
        'rectorado' => 'required',
        'sesion' => 'required'
      ]);

      sleep(1);

      $samara = Samara::create([
        'anio' => $request->anio,
        'numero' => $request->numero,
        'fecha' => $request->fecha,
        'rectorado_id' => $request->rectorado,
        'url_archivo' => $request->url_archivo
      ]);

      if (sizeof($request->sesion) > 0) {
        $samara->save();

        $sesiones = $request->sesion;
        foreach ($sesiones as $sesion_id) {
          $samarasesion = SamaraSesion::create([
            'samara_id' => $samara->id,
            'sesion_id' => $sesion_id
          ]);
        }
      }
      $numeroSamara = $samara->numero;

      bitacora(
        $accionId = 3,
        $seccion = 'Samaras',
        $registroId = $samara->id,
        $newValue = $samara
      );

      return redirect()->route('samaras.index')->with('success', 'Samará ' . $numeroSamara . ' creado correctamente.');
    } catch (Exception $e) {
      return redirect()->route('samaras.index')->with('warning', 'Error al crear el samará.')
        ->withErrors($validator);
    }
  }

  /**
   * Display the specified resource.
   */
  public function show(string $id)
  {
    $samara = Samara::where('id', $id)->firstOrFail();

    if (Auth::check()) {
      bitacora(
        $accionId = 2,
        $seccion = 'Samaras',
        $registroId = $id,
      );
    }

    return view('AcuerdosCU.Samara.show', ['samara' => $samara]);
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(string $id)
  {
    $rectorados = Rectorado::orderBy('id', 'desc')->get();
    $sesiones = Sesion::orderBy('fecha', 'desc')->get();
    $samara = Samara::where('id', $id)->firstOrFail();

    return view('AcuerdosCU.Samara.edit', compact('rectorados', 'sesiones', 'samara'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, string $id)
  {
    try {
      $validator = Validator::make($request->all(), [
        'anio' => ['required', 'regex:/^[A-Z]/'],
        'numero' => ['required', 'integer', 'regex:/^[0-9]/'],
        'fecha' => 'required',
        'rectorado' => 'required',
      ]);

      $samara = Samara::find($id);
      $old_value = $samara->getOriginal();

      $samara->anio = $request->input('anio');
      $samara->numero = $request->input('numero');
      $samara->fecha = $request->input('fecha');
      $samara->rectorado_id = $request->input('rectorado');
      $samara->url_archivo = $request->input('url_archivo');
      $samara->save();

      bitacora(
        $accionId = 4,
        $seccion = 'Samaras',
        $registroId = $id,
        $oldValue = json_encode($old_value),
        $newValue = json_encode($samara)
      );
      return redirect()->route('samaras.edit', ['samara' => $id])->with('success', 'Samara editado correctamente.');
    } catch (Exception $e) {
      return redirect()->route('samaras.edit', ['samara' => $id])->with('warning', 'Error al editar el samara.')
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

    $samaraSesion = SamaraSesion::where('samara_id', $id);
    $samaraSesion->delete();
    $samara = Samara::find($id);
    $numeroSamara = $samara->numero;

    bitacora(
      $accionId = 5,
      $seccion = 'Samaras',
      $registroId = $samara->id,
      $oldValue = $samara,
    );

    $samara->delete();

    return redirect()->route('samaras.index')->with('warning', 'Se elimino el samara ' . $numeroSamara . ' correctamente.');
  }

  public function showAll()
  {
    $rectorados = Rectorado::select()->orderBy('id', 'desc')->get();

    return view('AcuerdosCU.Samara.showAll', compact('rectorados'));
  }

  public function file(Request $request, int $id)
  {
    $request->validateWithBag('userDeletion', [
      'password' => ['required', 'current-password'],
    ]);

    $samara = Samara::find($id);
    $samara->status = false;
    $samara->save();

    return redirect()->route('samaras.index');
  }

  public function unarchive(Request $request, int $id)
  {
    $request->validateWithBag('userDeletion', [
      'password' => ['required', 'current-password'],
    ]);

    $samara = Samara::find($id);
    $samara->status = true;
    $samara->save();

    return redirect()->route('samaras.index');
  }

  public function deleteSession(int $samaraId, int $sesionId)
  {
    $samarasesion = SamaraSesion::select()->where('samara_id', $samaraId)->where('sesion_id', $sesionId)->firstOrFail();
    $samarasesion->delete();
    return redirect()->route('samaras.edit', ['samara' => $samaraId])->with('deleted', 'Se elimino la sesión correctamente.');
  }

  public function addSession(int $samaraId, Request $request)
  {
    if (sizeof($request->sesion) > 0) {

      $sesiones = $request->sesion;
      foreach ($sesiones as $sesion_id) {
        $samarasesion = SamaraSesion::create([
          'samara_id' => $samaraId,
          'sesion_id' => $sesion_id
        ]);
      }
    }

    return redirect()->route('samaras.edit', ['samara' => $samaraId])->with('added', 'Sesiones agregadas correctamente');
  }
}

<?php

namespace App\Http\Controllers\AcuerdosCU;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AcuerdosCU\Samara;
use App\Models\AcuerdosCU\SamaraSesion;
use App\Models\AcuerdosCU\Rectorado;
use App\Models\AcuerdosCU\Sesion;
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
    $validator = Validator::make($request->all(), [
      'anio' => ['required', 'alpha'],
      'numero' => ['required', 'integer'],
      'fecha' => 'required',
      'rectorado' => 'required',
      'sesion' => 'required'
    ]);

    if ($validator->fails()) {
      return redirect()->back()->withErrors($validator);
    } else {
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
    $samara = Samara::where('id', $id)->firstOrFail();

    return view('AcuerdosCU.Samara.edit', [
      'samara' => $samara,
      'rectorados' => $rectorados
    ]);
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, string $id)
  {
    $validator = Validator::make($request->all(), [
      'anio' => ['required', 'alpha', 'regex:/^[A-Z]/'],
      'numero' => ['required', 'integer', 'regex:/^[0-9]/'],
      'fecha' => 'required',
      'rectorado' => 'required',
    ]);

    if ($validator->fails()) {
      return redirect()->back()->withErrors($validator);
    } else {
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
}

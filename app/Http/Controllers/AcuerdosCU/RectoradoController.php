<?php

namespace App\Http\Controllers\AcuerdosCU;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AcuerdosCU\Rectorado;
use Illuminate\Support\Facades\Validator;

class RectoradoController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $rectorados = Rectorado::select()->orderBy('id', 'desc')->get();
    return view('AcuerdosCU.Rectorado.index', [
      'rectorados' => $rectorados
    ]);
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
      'ciclo' => ['required', 'regex:/^[0-9]{4}[-][0-9]{4}$/']
    ]);

    if ($validator->fails()) {
      return redirect()->back()->withErrors($validator);
    } else {
      $rectorado = Rectorado::create([
        'ciclo' => $request->ciclo
      ]);

      bitacora(
        $accionId = 3,
        $seccion = 'Rectorados',
        $registroId = $rectorado->id,
        $newValue = $rectorado
      );

      return redirect()->route('rectorados.index')
        ->with('success', 'Rectorado creado correctamente');
    }
  }

  /**
   * Display the specified resource.
   */
  public function show(string $id)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(string $id)
  {
    $rectorado = Rectorado::find($id);
    return view('AcuerdosCU.Rectorado.edit', ['rectorado' => $rectorado]);
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, string $id)
  {
    $validator = Validator::make($request->all(), [
      'ciclo' => ['required', 'regex:/^[0-9]{4}[-][0-9]{4}$/']
    ]);

    if ($validator->fails()) {
      return redirect()->back()->withErrors($validator);
    } else {
      $rectorado = Rectorado::find($id);
      $rectorado->ciclo = $request->input('ciclo');
      $old_value = $rectorado->getOriginal();
      $rectorado->save();

      bitacora(
        $accionId = 3,
        $seccion = 'Rectorados',
        $registroId = $rectorado->id,
        $oldValue = json_encode($old_value),
        $newValue = json_encode($rectorado)
      );

      return redirect()->route('rectorados.edit', ['rectorado' => $id])
        ->with('success', 'Rectorado actualizado correctamente');
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

    $rectorado = Rectorado::find($id);

    bitacora(
      $accionId = 5,
      $seccion = 'Rectorados',
      $registroId = $id,
      $oldValue = $rectorado
    );

    $rectorado->delete();

    return redirect()->route('rectorados.index')
      ->with('warning', 'Rectorado eliminado correctamente.');
  }

  public function file(Request $request, int $id)
  {
    $request->validateWithBag('userDeletion', [
      'password' => ['required', 'current-password'],
    ]);

    $rectorado = Rectorado::find($id);
    $rectorado->status = false;
    $rectorado->save();

    return redirect()->route('rectorados.index');
  }

  public function unarchive(Request $request, $rectorado_id)
  {
    $request->validateWithBag('userDeletion', [
      'password' => ['required', 'current-password'],
    ]);

    $rectorado = Rectorado::find($rectorado_id);
    $rectorado->status = true;
    $rectorado->save();

    return redirect()->route('rectorados.index');
  }
}
<?php

namespace App\Http\Controllers\formato911;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\formato911\UnidadAcademica;
use App\Models\formato911\Infraestructura;
use App\Models\formato911\InfraestructuraInmuebleConstruccion;
use App\Models\formato911\InfraestructuraInmueblePropiedad;
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
      $unidadesAcademicas = UnidadAcademica::select()->orderBy('id')->get();
      $infraestructuras = Infraestructura::orderBy('id', 'desc')->get();
      $inmuebleTipos = InfraestructuraInmuebleConstruccion::all();
      $aulaTipos = InfraestructuraInmueblePropiedad::all();
      return view('formato_911.infraestructura.index', compact('infraestructuras', 'unidadesAcademicas', 'inmuebleTipos', 'aulaTipos'));
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
        $validator = Validator::make($request->all(),[
          'unidad_academica' =>[ 'required'],
          'anio' => ['required'],
          'tipoInmueble' => ['required'],
          'tipoAula' => ['required'],
          'aulas_existentes'=> ['required'],
          'aulas_en_uso'=>[ 'required'],
          'aulas_adaptadas'=>[ 'required'],
          'talleres_existentes' =>[ 'required'],
          'talleres_en_uso' =>[ 'required'],
          'talleres_adaptados' =>[ 'required'],
          'laboratorios_existentes' =>[ 'required'],
          'laboratorios_en_uso' =>[ 'required'],
          'laboratorios_adaptados' =>[ 'required'],
          'laboratorio_computo' =>[ 'required'],
          'biblioteca' =>[ 'required']
        ]);

        try{
          if($validator->fails()){
            return redirect()->back()->withErrors($validator);
          } else {
            $infraestructura = Infraestructura::create([
              'unidad_academica_id' => $request->unidad_academica,
              'anio' => $request->anio,
              'inmueble_tipo_id' => $request->tipoInmueble,
              'aula_tipo_id' => $request->tipoAula,
              'aulas_existentes'=> $request->aulas_existentes,
              'aulas_en uso'=> $request->aulas_en_uso,
              'aulas_adaptadas'=> $request->aulas_adaptadas,
              'talleres_existentes' => $request->talleres_existentes,
              'talleres_en_uso' => $request->talleres_en_uso,
              'talleres_adapatdos' => $request->talleres_adaptados,
              'laboratorios_existentes' => $request->laboratorios_existentes,
              'laboratorios_en_uso' => $request-> laboratorios_en_uso,
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

             return redirect()->route('infraestructura.index')->with('success', 'Creado correctamente');
          }
        } catch(Exception  $e){
          return back()->with('error', 'error '.$e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $infraestructura = Infraestructura::find($id);

        if(Auth::check()){
          bitacora(
            $accion_id = 2,
            $seccion = 'Infraestructura',
            $registro_id = $infraestructura->id,
          );
        }

        return view('formato_911.infraestructura.show', compact('infraestructura'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
      $inmuebleTipos = InfraestructuraInmuebleConstruccion::all();
      $aulaTipos = InfraestructuraInmueblePropiedad::all();
        $infraestructura = Infraestructura::find($id);
        return view('formato_911.infraestructura.edit', compact('infraestructura', 'inmuebleTipos', 'aulaTipos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
      $validator = Validator::make($request->all(),[
        'anio' => ['required'],
        'tipoInmueble' => ['required'],
        'tipoAula' => ['required'],
        'aulas_existentes'=> ['required'],
        'aulas_en_uso'=>[ 'required'],
        'aulas_adaptadas'=>[ 'required'],
        'talleres_existentes' =>[ 'required'],
        'talleres_en_uso' =>[ 'required'],
        'talleres_adaptados' =>[ 'required'],
        'laboratorios_existentes' =>[ 'required'],
        'laboratorios_en_uso' =>[ 'required'],
        'laboratorios_adaptados' =>[ 'required'],
        'laboratorio_computo' =>[ 'required'],
        'biblioteca' =>[ 'required']
      ]);

      try{
        if($validator->fails()){
          return redirect()->back()->withErrors($validator);
        } else {
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

           return redirect()->route('infraestructura.edit', ['infraestructura'=>$id])->with('success', 'Creado correctamente');
        }
      } catch(Exception  $e){
        return back()->with('error', 'error '.$e->getMessage());
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

      return redirect()->route('infraestructura.index')->with('warning', 'Eliminado correctamente');
    }

    public function import(Request $request){
      $validator = Validator::make($request->all(), [
        'file'=> 'required|mimes:xlsx, xls'
      ]);

      try{
        if($validator->fails()){
          return redirect()->back()->withErrors($validator);
        } else {
          $file = $request->file('file');

          $import = new InfraestructuraImport;
          Excel::import($import, $file);

          // dd('Row count: ' . $import->getRowCount());
          $numero = $import->getRowCount();
          return redirect()->route('infraestructura.index')->with('success', 'Se importaron '.$numero.' registros.');
        }
      } catch(Exception  $e){
        return back()->with('error', 'error '.$e->getMessage());
      }
    }
}

<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FormatoImportacionController extends Controller
{
  public function __invoke($name)
  {
    try {
      $fileName = storage_path('app/' . $name . '.xlsx');
      dd($fileName);
      return response()->download($fileName);
    } catch (Exception $e) {
      return redirect()->back()->with('warning', 'Error al descargar el archivo ' . $e->getMessage());
    }
  }
}
